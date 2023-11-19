<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Litterhub\LitterhubProduct;
use App\Models\Solutionhub\SolutionhubProduct;

use App\Models\ChowhubProduct;
use App\Models\Invoice;
use App\Models\Rating;
use App\Models\User;
use App\Models\Post;


use App\Models\Order;
use App\Models\Policy;
use App\Models\SubProduct;

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
           
$todayNewPolicy= Policy::whereDate('created_at', today())->where(['is_policy' => 1])->count();
$todayNewUser= User::whereDate('created_at', today())->count();
$todayRenewal= Policy::whereDate('expiry_date', today())->where(['is_policy' => 1])->count();
$todayInvoice= Invoice::whereDate('created_at', today())->count();
$thisMonthNewPolicy= Policy::whereMonth('created_at', date('m'))->where(['is_policy' => 1])->count();
$thisMonthRenewal= Policy::whereMonth('expiry_date', date('m'))->where(['is_policy' => 1])->count();

$thisMonthPolicy= Policy::whereMonth('created_at', date('m'))->where(['is_policy' => 1])->sum('mis_commissionable_amount');
$thisMonthRenewalPolicy= Policy::whereMonth('expiry_date', date('m'))->where(['is_policy' => 1])->sum('mis_commissionable_amount');
$todayPolicy= Policy::whereDate('created_at', today())->where(['is_policy' => 1])->sum('mis_commissionable_amount');
$todayRenewalPolicy= Policy::whereDate('expiry_date', today())->where(['is_policy' => 1])->sum('mis_commissionable_amount');
$thisYearPolicy= Policy::whereYear('created_at', date('Y'))->where(['is_policy' => 1])->sum('mis_commissionable_amount');
$thisYearRenewalPolicy= Policy::whereYear('expiry_date', date('Y'))->where(['is_policy' => 1])->sum('mis_commissionable_amount');
$thisMonthInvoiceAmount= Invoice::whereMonth('created_at', date('m'))->sum('invoice_amount');
$thisMonthInvoice= Invoice::whereMonth('created_at', date('m'))->count();
$thisYearInvoiceAmount= Invoice::whereYear('created_at', date('Y'))->sum('invoice_amount');
$thisYearInvoice= Invoice::whereYear('created_at', date('Y'))->count();
$todayInvoiceAmount= Invoice::whereDate('created_at', today())->sum('invoice_amount');
$todayInvoice= Invoice::whereDate('created_at', today())->count();
$totalSubProduct= SubProduct::count();
$totalSales= Policy::where(['is_policy' => 1])->sum('mis_commissionable_amount');
$totalPolicy= Policy::where(['is_policy' => 1])->count();
$totalUser= User::count();
$totalInvoice= Invoice::count();


        return view('admin.dashboard',compact('todayNewPolicy','todayNewUser','todayRenewal','todayInvoice','thisMonthNewPolicy','thisMonthRenewal','thisMonthPolicy','thisMonthRenewalPolicy','todayPolicy','todayRenewalPolicy','thisYearPolicy','thisYearRenewalPolicy','thisMonthInvoiceAmount','thisMonthInvoice','thisYearInvoiceAmount','thisYearInvoice','todayInvoiceAmount','todayInvoice','totalSubProduct','totalSales','totalPolicy','totalUser','totalInvoice'));
    }

}
