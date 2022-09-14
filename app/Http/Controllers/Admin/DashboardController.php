<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Litterhub\LitterhubProduct;
use App\Models\Solutionhub\SolutionhubProduct;

use App\Models\ChowhubProduct;
use App\Models\Rating;
use App\Models\User;
use App\Models\Post;


use App\Models\Order;
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

}
