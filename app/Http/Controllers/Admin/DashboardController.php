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
           
$todayNewPolicy= Policy::whereDate('created_at', today())->count();
$todayNewUser= User::whereDate('created_at', today())->count();
$todayRenewal= Policy::whereDate('expiry_date', today())->count();
$todayInvoice= Invoice::whereDate('created_at', today())->count();
$thisMonthNewPolicy= Policy::whereMonth('created_at', date('m'))->count();
$thisMonthRenewal= Policy::whereMonth('expiry_date', date('m'))->count();

        return view('admin.dashboard',compact('todayNewPolicy','todayNewUser','todayRenewal','todayInvoice','thisMonthNewPolicy','thisMonthRenewal'));
    }

}
