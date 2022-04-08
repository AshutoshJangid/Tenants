<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\BillController;

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
    return view('login');
});
Route::middleware('auth')->group(function () {

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');



////////////////////////////////// SuperAdmin Routes//////////////////////////////////
    Route::get('/Sa/dashboard', function () {
        return view('superadmin.dashboard');
    })->name('sa.dashboard');
    // Route::get('/Sa/dashboard',[SuperAdminController::class,'index'])->name('sa.dashboard');

    // Add new Admin
    Route::view('/Sa/add-admin','superadmin.addAdmin')->name('sa.addAdmin');
    Route::post('/Sa/new-admin',[SuperAdminController::class,'newAdmin'])->name('sa.newAdmin');
    // View Tenant List
    Route::get('/Sa/view-adm-list',[SuperAdminController::class,'viewAdmList'])->name('sa.viewAdmList');
    // Change Admin status
    Route::get('/Sa/change-status/{id}',[SuperAdminController::class,'changeStatus'])->name('sa.changeStatus');


////////////////////////////////// Admin Routes //////////////////////////////////
    

    Route::get('/Ad/dashboard',[AdminController::class,'index'])->name('ad.dashboard'); 
    // Add new Tenant
    Route::view('/Ad/addtenant','admin.addtenant')->name('ad.addtenant');
    Route::post('/Ad/addtnt',[AdminController::class,'addtnt'])->name('ad.addtnt');
    // View Tenant List
    Route::get('/Ad/view-tnt-list',[AdminController::class,'viewTntList'])->name('ad.viewTntList');
    // Change user status
    Route::get('/Ad/change-status/{id}',[AdminController::class,'changeStatus'])->name('ad.changeStatus');
    // Tenant Personal Detail Page View
    Route::get('/Ad/tnt-details/{id}',[AdminController::class,'tntDetails'])->name('ad.tntDetails');
    // Tenant Rental Detail Page View
    Route::get('/Ad/tnt-rent-details/{id}',[AdminController::class,'tntRentDetails'])->name('ad.tntRentDetails');
    // Tenant Rental Detail Update
    Route::post('/Ad/add-tnt-details',[AdminController::class,'addtTntDetails'])->name('ad.addtntDetails');
    // Tenant Personal Detail Update
    Route::post('/Ad/update-tnt-details',[AdminController::class,'updatetTntDetails'])->name('ad.updateTntDetails');
    // Tenant Detail Page View
    Route::get('/Ad/tnt-view-details/{id}',[AdminController::class,'tntViewDetails'])->name('ad.tntViewDetails');


    // Tenant Bill Create Page View
    Route::get('/Ad/select-user-bill',[BillController::class,'selectUserBill'])->name('ad.selectUserBill');
    // Tenant Bill Create Form Page
    Route::post('/Ad/tnt-bill-form',[BillController::class,'tntBillForm'])->name('ad.tntBillForm');
    // Tenant Bill Create submit
    Route::post('/Ad/tnt-bill-create',[BillController::class,'tntBillCreate'])->name('ad.tntBillCreate');
    // Tenant Bill Create submit
    Route::get('/Ad/download-pdf/{bill_id}',[BillController::class,'downloadPdf'])->name('ad.downloadPdf');
    // Tenant Bills List User Wise
    Route::get('/Ad/user-bills/{tnt_id}',[BillController::class,'userBills'])->name('ad.userBills');
    // View Bill Setttlement Page
    Route::get('/Ad/select-bill', function () { return view('admin.selectBill'); })->name('ad.selectBill');
    // Bill Setttlement 
    Route::post('/Ad/settle-amount',[BillController::class,'settleAmt'])->name('ad.settleAmt');
    
    Route::post('/Ad/get-bill-detail',[BillController::class,'getBillDetail'])->name('ad.getBillDetail');





////////////////////////////////////// Tenant Routes //////////////////////////////////////
    Route::get('/Tn/dashboard', function () {
        return view('tenant.dashboard');
    })->name('tn.dashboard');
});
require __DIR__ . '/auth.php';
