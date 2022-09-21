<?php

use App\Http\Controllers\CustomersReportController;
use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\InvoicesAchiveController;
use App\Http\Controllers\InvoicesAttachmentsController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
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

Route::get('/', function () {
    return view('auth.login');
});



Auth::routes();

Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('invoices', InvoicesController::class);
Route::resource('sections', SectionsController::class);
Route::resource('products', ProductsController::class);
Route::resource('InvoicesAttachments', InvoicesAttachmentsController::class);
Route::resource('Archive',InvoicesAchiveController::class);

Route::get('/section/{id}', [InvoicesController::class, 'getproducts']);
Route::get('/InvoicesDetails/{id}', [InvoicesDetailsController::class, 'edit']);
Route::get('/View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'open_file']);
Route::post('delete_file',  [InvoicesDetailsController::class, 'destroy'])->name('delete_file');
Route::get('/download/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'get_file']);
Route::get('/Status_show/{id}',[InvoicesController::class,'show'])->name('Status_show');
Route::post('/Status_Update/{id}',[InvoicesController::class,'Status_Update'])->name('Status_Update');
Route::get('/edit_invoice/{id}',[InvoicesController::class,'edit']);

Route::get('Invoice_Paid',[InvoicesController::class,'Invoice_Paid']);
Route::get('Invoice_unPaid',[InvoicesController::class,'Invoice_unPaid']);
Route::get('Invoice_Partial',[InvoicesController::class,'Invoice_Partial']);

Route::get('Print_invoice/{id}',[InvoicesController::class,'Print_invoice']);
Route::get('export_invoices',[InvoicesController::class,'export']);

Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles',RoleController::class);

    Route::resource('users',UserController::class);

});

Route::get('invoices_report',[ReportsController::class,'index']);
Route::post('Search_invoices',[ReportsController::class,'Search_invoices']);

Route::get('customers_report',[CustomersReportController::class,'index'])->name("customers_report");
Route::post('Search_customers',[CustomersReportController::class,'Search_customers']);

Route::get('/{page}', [AdminController::class, 'index']);

