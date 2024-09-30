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
use Illuminate\Support\Facades\Auth;

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

        $users = User::all();

        return view('admin.dashboard', compact('users'));
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
    
        // Get the current authenticated user
        $user = Auth::user();
    
        // Check if the user is a Broker or Client
        $isRestrictedRole = $user->hasRole('Broker') || $user->hasRole('Client');
    
        // Define base query for policies with 'is_policy' => 1 and within the date range
        $policyQuery = Policy::where(['is_policy' => 1])->whereBetween('start_date', [$start, $end]);
        $renewalQuery = Policy::where(['is_policy' => 1])->whereBetween('expiry_date', [$start, $end]);
    
        // If the user is a Broker or Client, filter policies by user_id
        if ($isRestrictedRole) {
            $policyQuery->where('user_id', $user->id);
            $renewalQuery->where('user_id', $user->id);
        }
    
        // Count and sum based on the role
        $data['policyCount'] = $policyQuery->count();
        $data['policyAmount'] = $policyQuery->sum('gross_premium');
        $data['renewalCount'] = $renewalQuery->count();
        $data['renewalAmount'] = $renewalQuery->sum('gross_premium');
    
        $data['premiumShortCount'] = $policyQuery->where('mis_short_premium', '>', 0)->count();
        $data['premiumShortAmount'] = $policyQuery->where('mis_short_premium', '>', 0)->sum('mis_short_premium');
        $data['premiumDepositCount'] = $policyQuery->whereNull('mis_premium_deposit')->count();
        $data['premiumDepositAmount'] = $policyQuery->whereNull('mis_premium_deposit')->sum('gross_premium');
    
        $data['totalSubProduct'] = SubProduct::count();
        $data['totalSales'] = $policyQuery->sum('gross_premium');
        $data['totalPolicy'] = $policyQuery->count();
        $data['totalUser'] = User::count();
        $data['totalInvoice'] = Invoice::where(['status' => 'verified', 'payment_status' => 'paid'])
            ->whereBetween('created_at', [$start, $end])
            ->count();
        $data['closedRenewal'] = $renewalQuery->where('renew_status', 'like', '%' . 'closed' . '%')->count();
    
        $data['chartData'] = [];
        $data['pieChart'] = [];
    
        $subproducts = SubProduct::get();
    
        foreach ($subproducts as $key => $subproduct) {
            $closedPoliciesCount = Policy::where('renew_status', 'like', '%' . 'closed' . '%')
                ->where([
                    'is_policy' => 1,
                    'subproduct_id' => $subproduct->id
                ])
                ->whereBetween('expiry_date', [$start, $end]);
    
            // Apply user_id restriction if role is Broker or Client
            if ($isRestrictedRole) {
                $closedPoliciesCount->where('user_id', $user->id);
            }
    
            $closedPoliciesCount = $closedPoliciesCount->count();
    
            if ($closedPoliciesCount > 0) {
                $data['pieChart'][] = [
                    'name' => $subproduct->name,
                    'y' => $closedPoliciesCount
                ];
            }
        }
    
        // Prepare chart data based on the chart type
        if ($chartType == 'SubProduct') {
            $data['categories'] = SubProduct::get()->pluck('name');
            $subProducts = SubProduct::get()->pluck('id');
    
            foreach ($subProducts as $key => $subProduct) {
                $policyQuery = Policy::where(['is_policy' => 1, 'subproduct_id' => $subProduct])->whereBetween('start_date', [$start, $end]);
    
                // Apply user_id restriction if role is Broker or Client
                if ($isRestrictedRole) {
                    $policyQuery->where('user_id', $user->id);
                }
    
                $data['chartData']['count'][$key] = $policyQuery->count();
                $data['chartData']['price'][$key] = $policyQuery->sum('gross_premium');
            }
        } else if ($chartType == 'ChannelName') {
            $channels = Channel::limit(10)->get();
            $data['categories'] = $channels->pluck('name');
    
            foreach ($channels as $key => $channel) {
                $policyQuery = Policy::where(['is_policy' => 1, 'channel_name' => $channel['name']])->whereBetween('start_date', [$start, $end]);
    
                // Apply user_id restriction if role is Broker or Client
                if ($isRestrictedRole) {
                    $policyQuery->where('user_id', $user->id);
                }
    
                $data['chartData']['count'][$key] = $policyQuery->count();
                $data['chartData']['price'][$key] = $policyQuery->sum('gross_premium');
            }
        } else if ($chartType == 'CompanyName') {
            $company = Company::has('policies')
                ->withCount('policies')
                ->orderByDesc('policies_count')
                ->limit(10)
                ->get();
    
            $data['categories'] = $company->pluck('name');
            $companies = $company->pluck('id');
    
            foreach ($companies as $key => $company) {
                $policyQuery = Policy::where(['is_policy' => 1, 'company_id' => $company])->whereBetween('start_date', [$start, $end]);
    
                // Apply user_id restriction if role is Broker or Client
                if ($isRestrictedRole) {
                    $policyQuery->where('user_id', $user->id);
                }
    
                $data['chartData']['count'][$key] = $policyQuery->count();
                $data['chartData']['price'][$key] = $policyQuery->sum('gross_premium');
            }
        } elseif ($chartType == 'UserName') {
            $userIds = $request->users;
            $users = User::whereIn('id', $userIds)->get();
            $data['categories'] = $users->pluck('name');
    
            foreach ($users as $key => $user) {
                $policyQuery = Policy::where(['is_policy' => 1, 'user_id' => $user['id']])->whereBetween('start_date', [$start, $end]);
    
                // Apply user_id restriction if role is Broker or Client
                if ($isRestrictedRole) {
                    $policyQuery->where('user_id', $user->id);
                }
    
                $data['chartData']['count'][$key] = $policyQuery->count();
                $data['chartData']['price'][$key] = $policyQuery->sum('gross_premium');
            }
        }
    
        return response()->json($data);
    }
    
}
