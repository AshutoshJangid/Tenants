<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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



////////////////////////////////// SuperAdmin Routes////////////////////////////////
    Route::get('/Sa/dashboard', function () {
        return view('superadmin.dashboard');
    })->name('sa.dashboard');




///////////////////////////// Admin Routes ////////////////////////////////////////
    Route::get('/Ad/addtenant', function () {
        return view('admin.addtenant');
    })->name('ad.addtenant');

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

//////////////////////////////// Tenant Routes ////////////////////////////////
    Route::get('/Tn/dashboard', function () {
        return view('tenant.dashboard');
    })->name('tn.dashboard');
});
require __DIR__ . '/auth.php';
