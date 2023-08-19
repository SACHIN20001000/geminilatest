<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            if ($request->reference_name) {
                $query->where('id', $request->reference_name);
            }
            $data = $query
                ->orderBy('id', 'DESC')
                ->get();
            // Filter users where totalAmount is greater than 0
            $data = $data->filter(function ($user) {
                $totalAmount = $user->policies->sum('mis_commissionable_amount')
                    - $user->policies->sum('mis_short_premium')
                    - $user->policies->sum('payout_recovery');
                return $totalAmount > 0;
            });

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {
                    $action = '<input type="checkbox" name="checked"  class="checkSingle" value="' . $row->id . '"> 
                    ';
                    return $action;
                })
                ->addColumn('totalAmount', function ($row) {
                    $commission = $row->policies->sum('mis_commissionable_amount');
                    $shortPremium = $row->policies->sum('mis_short_premium');
                    $recovery = $row->policies->sum('payout_recovery');
                    $totalAmount = $commission - $shortPremium - $recovery;
                    return $totalAmount;
                })
                ->rawColumns(['checkbox'])
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
}
