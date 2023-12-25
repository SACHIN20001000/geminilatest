<?php

use Illuminate\Support\Facades\Route;
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
use App\Http\Controllers\Admin\EndrosmentController;
use App\Http\Controllers\Admin\NotepadController;
use App\Http\Controllers\Admin\ExpensesController;
use App\Http\Controllers\Admin\CommunicationController;
use App\Http\Controllers\Admin\IncomeController;
use App\Http\Controllers\Admin\RemainderController;
use App\Http\Controllers\Admin\ExportController;


use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CommunicationGroupController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\NewPayoutController;
use App\Http\Controllers\Admin\WebhookController;
use App\Http\Controllers\Admin\WhatsappChatsController;
use App\Http\Controllers\BacklinkController;
use App\Http\Controllers\GlobalSettingController;

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

Route::get('logout', function () {
    Auth::logout();
    return redirect('/admin');
});

Route::get('home', function () {
    Auth::logout();
    return redirect('/admin');
});
Route::get('/', function () {
    return view('home');
});

Route::resource('backlink', BacklinkController::class);
Route::any('backlink-delete/{id}', [BacklinkController::class, 'deleted'])->name('deleted');

Route::get('global_settings', [GlobalSettingController::class, 'index'])->name('global_settings.index');
Route::post('global_settings', [GlobalSettingController::class, 'store'])->name('global_settings.store');
Route::put('global_settings/{id}', [GlobalSettingController::class, 'update'])->name('global_settings.update');

Route::get('dummyMail', [LeadController::class, 'dummyMail'])->name('dummyMail');
Route::prefix('admin')->group(function () {
    Route::any('/webhook', [WebhookController::class, 'index'])->name('index')->middleware(['guest']);
    Route::any('remainder-cron', [RemainderController::class, 'cronRemainder'])->name('cronRemainder');

    Route::get('/', function () {
        return view('admin.login');
    })->middleware(['guest']);
    Route::get('register', function () {
        return view('admin.register');
    })->middleware(['guest']);
    Route::get('/forgotPassword', function () {
        return view('admin.forgotPassword');
    })->middleware(['guest']);
    Route::group(['middleware' => ['auth']], function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('dashboard-ajax', [DashboardController::class, 'dashboardAjax'])->name('dashboard.ajax');

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
        Route::resource('endrosment', EndrosmentController::class);
        Route::resource('notepad', NotepadController::class);
        Route::resource('expences', ExpensesController::class);
        Route::resource('income', IncomeController::class);
        Route::resource('communications', CommunicationController::class);
        Route::resource('remainder', RemainderController::class);

        Route::resource('group', CommunicationGroupController::class);
        // whatsapp
        Route::any('whatsapp-message-data', [WhatsappChatsController::class, 'lastMessageWhatapp'])->name('lastMessagewhatsapp');

        Route::get('whatsapp', [WhatsappChatsController::class, 'index'])->name('whatsapp');
        Route::post('whatsapp-send', [WhatsappChatsController::class, 'postSendMessage']);
        Route::post('getmessage', [WhatsappChatsController::class, 'getOldMessages']);
        Route::post('whatsapp-search',  [WhatsappChatsController::class, 'search'])->name('search');
        Route::post('whatsapp-chat-view', [WhatsappChatsController::class, 'chatView'])->name('chat_view');

        //     whatsapp
        Route::any('broker-payout', [PayoutController::class, 'brokerPayout'])->name('brokerPayout');
        Route::any('download/{filename?}', [PayoutController::class, 'download'])->name('download');
        Route::any('downloadsampleVeichel/{filename?}', [PayoutController::class, 'downloadsampleVeichel'])->name('downloadsampleVeichel');
        Route::any('export-policy', [ExportController::class, 'policyView'])->name('policyView');
        Route::any('store-policy', [ExportController::class, 'exportPolicy'])->name('exportPolicy');
        Route::any('export-vecial', [ExportController::class, 'vecialView'])->name('vecialView');
        Route::any('store-vecial', [ExportController::class, 'exportVecial'])->name('exportVecial');
        Route::any('getStatusChange', [PayoutController::class, 'getStatusChange'])->name('getStatusChange');
        Route::any('getInvoiceDetail', [NewPayoutController::class, 'getInvoiceDetail'])->name('getInvoiceDetail');
        Route::any('invoiceStore', [PayoutController::class, 'invoiceStore'])->name('invoiceStore');
        Route::any('getInvoice', [PayoutController::class, 'getInvoice'])->name('getInvoice');
        Route::any('renew_status', [PolicyController::class, 'renew_status'])->name('renew_status');
        Route::any('endrosments', [PolicyController::class, 'endrosment'])->name('endrosment');
        Route::any('sub-endrosment', [PolicyController::class, 'subEndrosment'])->name('subEndrosment');
        Route::any('commonEndrosment', [PolicyController::class, 'commonEndrosment'])->name('commonEndrosment');
        Route::any('bulkEmail', [PolicyController::class, 'bulkEmail'])->name('bulkEmail');
        Route::any('renewFolloup', [PolicyController::class, 'renewFolloup'])->name('renewFolloup');
        Route::any('renewAttachment', [PolicyController::class, 'renewAttachment'])->name('renewAttachment');
        Route::any('acceptPolicyLead', [PolicyController::class, 'acceptPolicyLead'])->name('acceptPolicyLead');
        Route::any('rejectpolicyLead', [PolicyController::class, 'rejectpolicyLead'])->name('rejectpolicyLead');
        Route::any('delAttachment/{id}', [PolicyController::class, 'delAttachment'])->name('delAttachment');
        Route::any('getProduct', [LeadController::class, 'getProduct'])->name('getProduct');
        Route::any('getCompany', [LeadController::class, 'getCompany'])->name('getCompany');
        Route::any('getSubProduct', [LeadController::class, 'getSubProduct'])->name('getSubProduct');
        Route::any('getMake', [LeadController::class, 'getMake'])->name('getMake');
        Route::any('getVarient', [LeadController::class, 'getVarient'])->name('getVarient');
        Route::any('getModel', [LeadController::class, 'getModel'])->name('getModel');
        Route::get('getStaff', [LeadController::class, 'getStaff'])->name('getStaff');
        Route::any('getUsers', [LeadController::class, 'getUsers'])->name('getUsers');
        Route::post('saveAssign', [LeadController::class, 'saveAssign'])->name('saveAssign');
        Route::post('changeStatus', [LeadController::class, 'changeStatus'])->name('changeStatus');
        Route::post('leadAttachment', [LeadController::class, 'leadAttachment'])->name('leadAttachment');



        Route::get('chat', [ChatsController::class, 'index'])->name('chat');
        Route::post('send', [ChatsController::class, 'postSendMessage']);
        Route::post('getmessage', [ChatsController::class, 'getOldMessages']);
        Route::post('search',  [ChatsController::class, 'search'])->name('search');
        Route::post('chat-view', [ChatsController::class, 'chatView'])->name('chat_view');
        Route::get('message-data', [ChatsController::class, 'lastMessage'])->name('lastMessage');
        Route::get('view-profile', [App\Http\Controllers\Admin\AdminController::class, 'viewProfile'])->name('viewProfile');
        Route::get('update-profile', [App\Http\Controllers\Admin\AdminController::class, 'updateProfile'])->name('updateProfile');
        Route::post('update-user-profile/{id}', [App\Http\Controllers\Admin\AdminController::class, 'updateUserProfile'])->name('updateUserProfile');
        Route::post('leadQuotes', [LeadController::class, 'leadQuotes'])->name('leadQuotes');
        Route::any('new-payout', [NewPayoutController::class, 'index'])->name('new-payout.index');
        Route::any('get-payout', [NewPayoutController::class, 'getPayouts'])->name('getPayouts');
        Route::any('payoutList', [NewPayoutController::class, 'payoutList'])->name('payoutList');
        Route::get('generate-pdf', [NewPayoutController::class, 'generatePDF']);

        Route::any('generateInvoice', [NewPayoutController::class, 'generateInvoice'])->name('generateInvoice');
        Route::any('pending-invoice', [InvoiceController::class, 'index'])->name('invoice');
        Route::any('invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
        Route::any('invoice/{id}/edit', [InvoiceController::class, 'edit'])->name('invoice.edit');
        Route::any('invoice/{id}/delete', [InvoiceController::class, 'destroy'])->name('invoice.destroy');
        Route::get('/pdf/download/{id}', [InvoiceController::class, 'downloadInvoice'])->name('pdf.download');
        Route::any('invoice', [InvoiceController::class, 'verifiedInvoice'])->name('invoice.verified');
        Route::any('changeStatus/{id}', [InvoiceController::class, 'changeStatus'])->name('invoice.changeStatus');
        Route::any('/update-payment-status', [InvoiceController::class, 'updatePaymentStatus'])->name('invoice.updatePaymentStatus');

    });
    Route::any('acceptLead', [LeadController::class, 'acceptLead'])->name('acceptLead');

    Route::any('rejectLead', [LeadController::class, 'rejectLead'])->name('rejectLead');
});

Auth::routes([
    'register' => true
]);

Route::prefix('')->group(function () {
    Route::get('{any}', function () {
        return redirect('/admin');
    })->where('any', '.*');
});
