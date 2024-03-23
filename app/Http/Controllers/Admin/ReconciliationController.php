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


        $date = strtotime(date('Y-m-d'));
        $today = date('Y-m-d', strtotime('-1 days', $date));
        $daysabove = date('Y-m-d', strtotime('-30 days', $date));

        if (isset($request->internal_commission) && !empty($request->internal_commission)) {
            $query->where('internal_commission', 'LIKE', '%' . $request->internal_commission . '%');
        }

        if (isset($request->expiry_from) && !empty($request->expiry_from) && !empty($request->expiry_to) && isset($request->expiry_to)) {
            $query->whereBetween('start_date', [$request->expiry_from, $request->expiry_to]);
        } else {
            $query->whereBetween('start_date', [$today, $daysabove]);
        }

        if (Auth::user()->hasRole('Broker') ||  Auth::user()->hasRole('Client')) {
            $query->where('user_id', Auth::user()->id);
        }






        $query->orderby('start_date', 'ASC');


        $leads = $query->get();

        if ($request->ajax()) {
            return DataTables::of($leads)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('policy.show', $row->id) . '" class="edit btn btn-success btn-sm">View</a>';
                    return $actionBtn;
                })
                ->addColumn('internalCommission', function ($row) {
                    $action = '<select class="form-control commission_change" data-id="' . $row->id . '" >';
                    $action .= '<option value="Yes" ' . ($row->internal_commission == 'Yes' ? 'selected' : '') . '>Yes</option>';
                    $action .= '<option value="No" ' . ($row->internal_commission == 'No' ? 'selected' : '') . '>No</option>';
                    $action .= '</select>';

                    return $action;
                })
                ->rawColumns(['action', 'internalCommission'])
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
                'policy_no', 'payout_recd',
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
                                $payout_saved = $finalCsv['payout_recd'] - $policy->internal_payout_expected;
                                if ($finalCsv['payout_recd'] == $policy->internal_payout_expected) {
                                    $finalCsv['commission_status'] = 'Yes';
                                } else {
                                    $finalCsv['commission_status'] = 'No';
                                }
                                $payoutPrecentage = ($finalCsv['payout_recd'] / $policy->internal_payout_expected) * 100;

                                $policy->update([
                                    'internal_payout_received' => $finalCsv['payout_recd'],
                                    'internal_commission' => $finalCsv['commission_status'],
                                    'internal_payout_saved' => $payout_saved,
                                    'internal_payout_percentage' => $payoutPrecentage,
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
    public function reconciliationUpdate(Request $request)
    {
        $policy = Policy::find($request->id);
        $policy->update(['internal_commission' => $request->value]);
        return response()->json(['success' => 'Updated Successfully']);
    }
}
