<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;
use App\Models\Remainder;
use DataTables;
use App\Traits\WhatsappApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReconciliationController extends Controller
{
    use WhatsappApi;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        // echo '<pre>'; print_r($request->all()); die;
        $query = Policy::with('users', 'lead', 'insurances', 'products', 'subProduct', 'lead.assigns', 'company', 'attachments')->where(['is_policy' => 1]);
        if (isset($request->search_anything)   && !empty($request->search_anything)) {
            // $query->orwhereHas('lead', function ($q) use ($request) {


            // });
            $searchParam = ['holder_name', 'phone', 'email', 'reg_no', 'policy_no'];
            foreach ($searchParam as $key => $value) {

                if ($key == 0) {
                    $query->where($value, 'like', '%' . $request->search_anything . '%');
                } else {
                    $query->orwhere($value, 'like', '%' . $request->search_anything . '%');
                }
            }
        }

        $date = strtotime(date('Y-m-d'));
        $today = date('Y-m-d', strtotime('-1 days', $date));
        $daysabove = date('Y-m-d', strtotime('-30 days', $date));

        if (isset($request->expiry_from) && !empty($request->expiry_from) && !empty($request->expiry_to) && isset($request->expiry_to)) {
            $query->whereBetween('start_date', [$request->expiry_from, $request->expiry_to]);
        } else {
            $query->whereBetween('start_date', [$today, $daysabove]);
        }


        if (isset($request->type) && !empty($request->type)) {
            if ($request->type == 'premium_short') {
                $query->where('mis_short_premium', '>', 0);
            } elseif ($request->type == 'premium_deposit') {
                $query->whereNull('mis_premium_deposit');
            }
        }
        if (Auth::user()->hasRole('Broker') ||  Auth::user()->hasRole('Client')) {
            $query->where('user_id', Auth::user()->id);
        }

        if (isset($request->product)   && !empty($request->product)) {

            $query->whereIn('subproduct_id', $request->product);
        }
        if (isset($request->renew_status_search)   && !empty($request->renew_status_search)) {
            $query->where('renew_status', 'like', '%' . $request->renew_status_search . '%');
        }
        if (isset($request->mis_transaction_type)   && !empty($request->mis_transaction_type)) {
            $query->whereIn('mis_transaction_type', $request->mis_transaction_type);
        }
        if (isset($request->follow_ups)   && !empty($request->follow_ups)) {

            $query->where('follow_up', $request->follow_ups);
        }
        if (isset($request->is_paid)   && !empty($request->is_paid)) {

            if ($request->is_paid == 1) {
                $query->whereColumn('mis_amount_paid', '=', 'gross_premium');
            } else {
                $query->whereColumn('mis_amount_paid', '!=', 'gross_premium');
            }
        }


        if (isset($request->users)   && !empty($request->users)) {
            $query->whereIn('user_id', $request->users);
        }
        if (isset($request->company_id)   && !empty($request->company_id)) {
            $query->whereIn('company_id', $request->company_id);
        }
        if (isset($request->status)   && !empty($request->status)) {
            $query->where('status', $request->status);
        }
        if (isset($request->duplicate) && !empty($request->duplicate) && $request->duplicate == true) {
            $duplicatePolicyNos = Policy::select('policy_no')
                ->groupBy('policy_no')
                ->havingRaw('COUNT(policy_no) > 1')
                ->pluck('policy_no');

            $query->whereIn('policy_no', $duplicatePolicyNos);
        }
        if ($request->id == 1) {
            if (isset($request->duplicate) && !empty($request->duplicate) && $request->duplicate == true) {
                $query->orderby('policy_no', 'desc');
            } else {
                $query->orderby('start_date', 'desc');
            }
        } else {
            $query->orderby('expiry_date', 'ASC');
        }

        $count =  $query->count();
        $leads = $query->get();

        if ($request->ajax()) {
            return DataTables::of($leads)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('policy.show', $row->id) . '" class="edit btn btn-success btn-sm">View</a>';
                    return $actionBtn;
                })
                ->make(true);
        }
        return view('admin.reconciliation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload()
    {


        return view('admin.reconciliation.addEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->file('file')) {
            $path = $request->file('file')->getRealPath();  /// DEFINE FILE PATH HERE///

            //turn into array
            $file = file($path);

            $header = array_slice($file, 0, 1);

            if (!empty($header)) {
                foreach ($header as $head) {
                    $headerQuotes = str_replace('"', '', trim(strtolower($head)));

                    $headerF = explode(',', str_replace(' ', '_', trim(strtolower($headerQuotes))));
                }
            }
            $csvdata = array_slice($file, 1);
            $requiredHeaders = [
                'policy_no', 'payout_expected', 'payout_recd', 'commission_status'
            ];
            if (!empty($csvdata)) {
                if (count(array_intersect($requiredHeaders, $headerF)) == count($requiredHeaders)) {

                    foreach ($csvdata as $key => $csv) {
                        $csvArrF = explode(",", trim(strtolower($csv)));
                        if (count($csvArrF) === count($headerF)) {


                            $finalCsvData[] = array_combine($headerF, $csvArrF);
                        }
                    }


                    foreach ($finalCsvData as $key => $finalCsv) {

                        try {
                            DB::beginTransaction();

                            $policy = Policy::where('policy_no', $finalCsv['policy_no'])->first();

                            if ($policy) {
                                $payout_saved = $finalCsv['payout_recd'] - $policy->mis_commission;
                                $policy->update([
                                    'internal_payout_expected' => $finalCsv['payout_expected'],
                                    'internal_payout_received' => $finalCsv['payout_recd'],
                                    'internal_commission' => $finalCsv['commission_status'],
                                    'internal_payout_saved' => $payout_saved
                                ]);
                            }

                            DB::commit();
                        } catch (\Exception $e) {

                            echo $e->getMessage();
                            die;
                            DB::rollback();
                            return back()->with('error', 'Error: ' . $e->getMessage());
                        }
                    }
                    return back()->with('success', 'Imported successfully!');
                }
                return back()->with('error', 'Error, Missing or Invalid Headers in the file!');
            }
        }

        return back()->with('error', 'Error, Please upload the file!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $remainder = Remainder::find($id);
        return view('admin.remainder.addEdit', compact('remainder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $remainder = Remainder::find($id);
        $remainder->update($request->all());
        return redirect()->route('remainder.index')->with('success', 'Remainder Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        Remainder::find($id)->delete();
        return redirect()->route('remainder.index')->with('success', 'Remainder Deleted Successfully');
    }
}
