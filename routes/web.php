<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubProductController;
use App\Http\Controllers\Admin\InsuranceController;
use App\Http\Controllers\Admin\MakeController;
use App\Http\Controllers\Admin\MakeModelController;
use App\Http\Controllers\Admin\LeadController;


use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;



/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */
Route::get('logout', function ()
{
    Auth::logout();
    return redirect('/admin');
});

Route::get('home', function ()
{
    Auth::logout();
   return redirect('/admin');
});



Route::prefix('admin')->group(function ()
{
    Route::get('/', function ()
    {
        return view('admin.login');
    })->middleware(['guest']);
    ;
    Route::get('/forgotPassword', function ()
    {
        return view('admin.forgotPassword');
    })->middleware(['guest']);

    Route::group(['middleware' => ['role:Admin']], function ()
    {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
       
        Route::resource('users', UserController::class);
        Route::resource('company', CompanyController::class);
        Route::resource('product', ProductController::class);
        Route::resource('subproduct', SubProductController::class);
        Route::resource('insurance', InsuranceController::class);
        Route::resource('make', MakeController::class);
        Route::resource('model', MakeModelController::class);
        Route::resource('leads', LeadController::class);
        Route::any('getProduct', [LeadController::class, 'getProduct'])->name('getProduct');
        Route::any('getSubProduct', [LeadController::class, 'getSubProduct'])->name('getSubProduct');
        Route::any('getVarient', [LeadController::class, 'getVarient'])->name('getVarient');
        Route::get('getStaff', [LeadController::class, 'getStaff'])->name('getStaff');
        Route::post('saveAssign', [LeadController::class, 'saveAssign'])->name('saveAssign');
        Route::post('changeStatus', [LeadController::class, 'changeStatus'])->name('changeStatus');
        Route::post('leadAttachment', [LeadController::class, 'leadAttachment'])->name('leadAttachment');
        Route::post('leadQuotes', [LeadController::class, 'leadQuotes'])->name('leadQuotes');

        Route::get('view-profile', [App\Http\Controllers\Admin\AdminController::class, 'viewProfile'])->name('viewProfile');
        Route::get('update-profile', [App\Http\Controllers\Admin\AdminController::class, 'updateProfile'])->name('updateProfile');
        Route::post('update-user-profile/{id}', [App\Http\Controllers\Admin\AdminController::class, 'updateUserProfile'])->name('updateUserProfile');
    });
});

Auth::routes([
    'register' => false
]);

Route::prefix('')->group(function ()
{
    Route::get('{any}', function ()
    {
        return redirect('/admin');
    })->where('any', '.*');
});


