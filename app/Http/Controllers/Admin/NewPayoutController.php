<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Policy;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class NewPayoutController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $query = User::with(['policies', 'roles'])->has('policies');
            if ($request->interval) {
                $intervalParts = explode(' - ', $request->interval);
                $startDate = Carbon::parse($intervalParts[0]);
                $endDate = Carbon::parse($intervalParts[1]);

                $query->whereHas('policies', function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('created_at', [$startDate, $endDate]);
                });
            }
            $query->whereHas('policies', function ($q) {
                $q->whereNull('invoice_id')->where('is_mis', 1);
            });
            if ($request->reference_name) {
                $query->where('id', $request->reference_name);
            }
            $data = $query
                ->orderBy('id', 'DESC')
                ->get();
            // Filter users where totalAmount is greater than 0
            $data = $data->filter(function ($user) {
                $totalAmount = $user->policies->sum('mis_commission')
                    - $user->policies->sum('mis_short_premium')
                    - $user->policies->sum('payout_recovery');
                return $totalAmount != 0;
            });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    $action = '<input type="checkbox" name="checked"  class="checkSingle" value="' . $row->id . '"> 
                    ';
                    return $action;
                })
                ->addColumn('name', function ($row) {
                    $link = '<a href="' . route('payoutList', [
                        'reference_name' => $row->id,
                        'interval' => request('interval'),
                    ]) . '">' . $row->name . '</a>';
                    return $link;
                })
                ->addColumn('totalAmount', function ($row) {
                    $commission = $row->policies->sum('mis_commission');
                    $shortPremium = $row->policies->sum('mis_short_premium');
                    $recovery = $row->policies->sum('payout_recovery');
                    $totalAmount = $commission - $shortPremium - $recovery;
                    return $totalAmount;
                })
                ->rawColumns(['checkbox', 'name'])
                ->make(true);
        }
        $users =  User::all();
        return view('admin.new-payout.index', compact('users'));
    }

    public function getPayouts(Request $request)
    {
        $query = Policy::select('*');
        if ($request->interval) {
            $intervalParts = explode(' - ', $request->interval);
            $startDate = Carbon::parse($intervalParts[0]);
            $endDate = Carbon::parse($intervalParts[1]);
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        if ($request->reference_name) {
            $query->where('user_id', $request->reference_name);
        }
        $payable = $query->sum('mis_commission');
        $receivable = $query->sum('mis_short_premium');
        $recovery = $query->sum('payout_recovery');
        $response = [];
        $response['payable'] = $payable;
        $response['receivable'] = $receivable;
        $response['recovery'] = $recovery;
        return $response;
    }

    public function getInvoiceDetail(Request $request)
    {

        $query = User::with(['policies'])->has('policies');
        if ($request->interval) {
            $intervalParts = explode(' - ', $request->interval);
            $startDate = Carbon::parse($intervalParts[0]);
            $endDate = Carbon::parse($intervalParts[1]);

            $query->whereHas('policies', function ($q) use ($startDate, $endDate) {
                $q->whereBetween('created_at', [$startDate, $endDate]);
            });
        }
        if ($request->ids) {
            $query->whereIn('id', $request->ids);
        }
        $query->whereHas('policies', function ($q) {
            $q->whereNull('invoice_id')->where('is_mis', 1);
        });
        $data = $query
            ->orderBy('id', 'DESC')
            ->get();

        $data = $data->filter(function ($user) {
            $totalAmount = $user->policies->sum('mis_commission')
                - $user->policies->sum('mis_short_premium')
                - $user->policies->sum('payout_recovery');
            return $totalAmount != 0;
        });

        if ($data->count()) {
            foreach ($data as $key => $user) {
                $totalAmount = $user->policies->sum('mis_commission') - $user->policies->sum('mis_short_premium') - $user->policies->sum('payout_recovery');
                $tdsPercentage = $user->tds_percentage ?? 0; // Default to 0 if tds_percentage is not set
                $invoiceAmount = $totalAmount * (1 - ($tdsPercentage / 100));

                $invoice =   Invoice::create([
                    'user_id' => $user->id,
                    'invoice_id' => random_int(1000, 9999),
                    'invoice_date' => now(),
                    'transfer_date' => now(),
                    'bank_detail' => $user->account_no ?? 'N/A',
                    'name' => $user->account_name ?? 'N/A',
                    'invoice_amount' => $invoiceAmount,
                    'tds' => $user->tds_percentage ?? 0,
                    'amount_transfer' => $totalAmount,
                    'adjusted' => 'N/A',
                    'advance_payout' => $user->advance_payout,
                    'recovery_cases' => $user->policies->sum('payout_recovery'),
                    'short_premium' => $user->policies->sum('mis_short_premium'),
                    'total_Payout' => $user->policies->sum('mis_commission'),
                ]);
                if (!empty($user->advance_payout)) {
                    $amount = $user->advance_payout - $request->invoice_amount;
                    $user->update(['advance_payout' => $amount]);
                }
                $user->policies()->update(['invoice_id' => $invoice->id]);


                $subject = "Payment Notification: Payouts for <$request->interval> Month's Insurance Policies";
              

                Mail::send('admin.email.invoicePolicy', ['invoice' => $invoice], function ($messages) use ($user, $subject) {
                    $messages->to($user->email);
                    $messages->bcc('geminiservices@outlook.com');
                    $messages->subject($subject);
                });
            }

            return response()->json(['success' => true, 'message' => 'Invoice generated successfully']);
        }
    }

    public function payoutList(Request $request)
    {
        if ($request->ajax()) {

            $query = Policy::with('insurances', 'company', 'products', 'subProduct', 'models');
            if ($request->interval) {
                $intervalParts = explode(' - ', $request->interval);
                $startDate = Carbon::parse($intervalParts[0]);
                $endDate = Carbon::parse($intervalParts[1]);
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }
            $query->whereNull('invoice_id')->where('is_mis', 1);
            if ($request->reference_name) {
                $query->where('user_id', $request->reference_name);
            }
            $data = $query
                ->orderBy('id', 'DESC')
                ->get();
            $data = $data->filter(function ($user) {
                $totalAmount = $user->sum('mis_commission')
                    - $user->sum('mis_short_premium')
                    - $user->sum('payout_recovery');
                return $totalAmount != 0;
            });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    $action = '<input type="checkbox" name="checked"  class="checkSingle" value="' . $row->id . '"> 
                    ';
                    return $action;
                })
                ->rawColumns(['checkbox'])
                ->make(true);
        }

        return view('admin.new-payout.payout-list');
    }

    public function generateInvoice(Request $request)
    {

        $policies =  Policy::whereIn('id', $request->ids)->get();
        $user = User::find($request->user_id);



        if ($policies->count()) {
            $totalAmount = $policies->sum('mis_commission') - $policies->sum('mis_short_premium') - $policies->sum('payout_recovery');
            $tdsPercentage = $user->tds_percentage ?? 0; // Default to 0 if tds_percentage is not set
            $invoiceAmount = $totalAmount * (1 - ($tdsPercentage / 100));

            $invoice =   Invoice::create([
                'user_id' => $request->user_id,
                'invoice_id' => random_int(1000, 9999),
                'invoice_date' => now(),
                'transfer_date' => now(),
                'bank_detail' => $user->account_no ?? 'N/A',
                'name' => $user->account_name ?? 'N/A',
                'invoice_amount' => $invoiceAmount,
                'tds' => $user->tds_percentage ?? 0,
                'amount_transfer' => $totalAmount,
                'adjusted' => 'N/A',
                'advance_payout' => $user->advance_payout,
                'recovery_cases' => $policies->sum('payout_recovery'),
                'short_premium' => $policies->sum('mis_short_premium'),
                'total_Payout' => $policies->sum('mis_commission'),
            ]);
            if (!empty($user->advance_payout)) {
                $amount = $user->advance_payout - $request->invoice_amount;
                $user->update(['advance_payout' => $amount]);
            }
            foreach ($policies as $policy) {
                $policy->update(['invoice_id' => $invoice->id]);
            }
            $subject = "Payment Notification: Payouts for <$request->interval> Month's Insurance Policies";

            Mail::send('admin.email.invoicePolicy', ['policy' => $user], function ($messages) use ($user, $subject) {
                $messages->to($user->email);
                $messages->bcc('geminiservices@outlook.com');
                $messages->subject($subject);
            });



            return response()->json(['success' => true, 'message' => 'Invoice generated successfully']);
        }
    }
}
