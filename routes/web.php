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
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\ChatsController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ChannelController;
use App\Http\Controllers\Admin\PayoutController;


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
    Route::get('register', function ()
        {
            return view('admin.register');
        })->middleware(['guest']);
    Route::get('/forgotPassword', function ()
    {
        return view('admin.forgotPassword');
    })->middleware(['guest']);

Route::group(['middleware' => ['auth']], function () { 
   
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
       
        Route::resource('users', UserController::class);
        Route::resource('company', CompanyController::class);
        Route::resource('product', ProductController::class);
        Route::resource('subproduct', SubProductController::class);
        Route::resource('insurance', InsuranceController::class);
        Route::resource('make', MakeModelController::class);
        Route::resource('model', MakeController::class);
        Route::resource('leads', LeadController::class);
        Route::resource('policy', PolicyController::class);
        Route::resource('report', ReportController::class);
        Route::resource('channel', ChannelController::class);
        Route::resource('payout', PayoutController::class);
        Route::any('renew_status', [PolicyController::class, 'renew_status'])->name('renew_status');
        Route::any('endrosment', [PolicyController::class, 'endrosment'])->name('endrosment');
        Route::any('commonEndrosment', [PolicyController::class, 'commonEndrosment'])->name('commonEndrosment');
        Route::any('getProduct', [LeadController::class, 'getProduct'])->name('getProduct');
        Route::any('getSubProduct', [LeadController::class, 'getSubProduct'])->name('getSubProduct');
        Route::any('getVarient', [LeadController::class, 'getVarient'])->name('getVarient');
        Route::any('getModel', [LeadController::class, 'getModel'])->name('getModel');
        Route::get('getStaff', [LeadController::class, 'getStaff'])->name('getStaff');
        Route::post('saveAssign', [LeadController::class, 'saveAssign'])->name('saveAssign');
        Route::post('changeStatus', [LeadController::class, 'changeStatus'])->name('changeStatus');
        Route::post('leadAttachment', [LeadController::class, 'leadAttachment'])->name('leadAttachment');
       
   
        Route::get('dummyMail', [LeadController::class, 'dummyMail'])->name('dummyMail');
        Route::get('chat', [ChatsController::class, 'index'])->name('chat');
        Route::post('send', [ChatsController::class, 'postSendMessage']);
        Route::post('getmessage',[ChatsController::class, 'getOldMessages']);
        Route::post('search',  [ChatsController::class, 'search'])->name('search');
        Route::post('chat-view', [ChatsController::class, 'chatView'])->name('chat_view');
        Route::get('message-data', [ChatsController::class, 'lastMessage'])->name('lastMessage');
        Route::get('view-profile', [App\Http\Controllers\Admin\AdminController::class, 'viewProfile'])->name('viewProfile');
        Route::get('update-profile', [App\Http\Controllers\Admin\AdminController::class, 'updateProfile'])->name('updateProfile');
        Route::post('update-user-profile/{id}', [App\Http\Controllers\Admin\AdminController::class, 'updateUserProfile'])->name('updateUserProfile');
        Route::post('leadQuotes', [LeadController::class, 'leadQuotes'])->name('leadQuotes');
});
Route::any('acceptLead', [LeadController::class, 'acceptLead'])->name('acceptLead');

Route::any('rejectLead', [LeadController::class, 'rejectLead'])->name('rejectLead');
});

Auth::routes([
    'register' => true
]);

Route::prefix('')->group(function ()
{
    Route::get('{any}', function ()
    {
        return redirect('/admin');
    })->where('any', '.*');
});


