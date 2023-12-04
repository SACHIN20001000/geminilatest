<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Channel;
use App\Models\Company;
use App\Models\Insurance;
use App\Models\Invoice;
use App\Models\Rating;
use App\Models\User;
use App\Models\Post;


use App\Models\Order;
use App\Models\Policy;
use App\Models\SubProduct;

use function PHPUnit\Framework\isNull;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * dashboard view
     * @return type
     */
    public function index()
    {



        return view('admin.dashboard');
    }

    /**
     * dashboard view
     * @return type
     */
    public function dashboardAjax(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $chartType = $request->chartType;
        $data = [];
        $data['policyCount'] = Policy::where(['is_policy' => 1])->whereBetween('start_date', [$start, $end])->count();
        $data['policyAmount'] = Policy::where(['is_policy' => 1])->whereBetween('start_date', [$start, $end])->sum('gross_premium');
        $data['renewalCount'] = Policy::where(['is_policy' => 1])->whereBetween('expiry_date', [$start, $end])->count();
        $data['renewalAmount'] = Policy::where(['is_policy' => 1])->whereBetween('expiry_date', [$start, $end])->sum('gross_premium');
        $data['premiumShortCount'] = Policy::where(['is_policy' => 1])->whereBetween('start_date', [$start, $end])->where('mis_short_premium', '>', 0)->count();
        $data['premiumShortAmount'] = Policy::where(['is_policy' => 1])->whereBetween('start_date', [$start, $end])->where('mis_short_premium', '>', 0)->sum('mis_short_premium');
        $data['premiumDepositCount'] = Policy::where(['is_policy' => 1])
            ->whereBetween('start_date', [$start, $end])
            ->whereNull('mis_premium_deposit')
            ->count();

        $data['premiumDepositAmount'] = Policy::where(['is_policy' => 1])
            ->whereBetween('start_date', [$start, $end])
            ->whereNull('mis_premium_deposit')
            ->sum('gross_premium');
        $data['totalSubProduct'] = SubProduct::count();
        $data['totalSales'] = Policy::where(['is_policy' => 1])->whereBetween('start_date', [$start, $end])->sum('gross_premium');
        $data['totalPolicy'] = Policy::where(['is_policy' => 1])->whereBetween('start_date', [$start, $end])->count();
        $data['totalUser'] = User::whereBetween('created_at', [$start, $end])->count();
        $data['totalInvoice'] = Invoice::where(['status' => 'verified', 'payment_status' => 'paid'])->whereBetween('created_at', [$start, $end])->count();
        $data['closedRenewal'] = Policy::where(['is_policy' => 1])->whereBetween('expiry_date', [$start, $end])->where('renew_status', 'like', '%' . 'closed' . '%' )->count();

        $data['chartData'] = [];

        if ($chartType == 'SubProduct') {
            $data['categories'] = SubProduct::get()->pluck('name');
            $subProducts = SubProduct::get()->pluck('id');
            foreach ($subProducts as $key => $subProduct) {
                $data['chartData']['count'][$key] = Policy::where(['is_policy' => 1, 'subproduct_id' => $subProduct])->whereBetween('start_date', [$start, $end])->count();
                $data['chartData']['price'][$key] = Policy::where(['is_policy' => 1, 'subproduct_id' => $subProduct])->whereBetween('start_date', [$start, $end])->sum('gross_premium');
            }
        } else if ($chartType == 'ChannelName') {
            $data['categories'] = Channel::get()->pluck('name');
            $channels = Channel::get()->pluck('id');
            foreach ($channels as $key => $channel) {
                $data['chartData']['count'][$key] = Policy::where(['is_policy' => 1, 'company_id' => $channel])->whereBetween('start_date', [$start, $end])->count();
                $data['chartData']['price'][$key] = Policy::where(['is_policy' => 1, 'company_id' => $channel])->whereBetween('start_date', [$start, $end])->sum('gross_premium');
            }
        } else if ($chartType == 'CompanyName') {
            $data['categories'] = Company::get()->pluck('name');
            $companies = Company::get()->pluck('id');
            foreach ($companies as $key => $company) {
                $data['chartData']['count'][$key] = Policy::where(['is_policy' => 1, 'company_id' => $company])->whereBetween('start_date', [$start, $end])->count();
                $data['chartData']['price'][$key] = Policy::where(['is_policy' => 1, 'company_id' => $company])->whereBetween('start_date', [$start, $end])->sum('gross_premium');
            }
        }
        return response()->json($data);
    }
}
