<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Session;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware('auth')->group(function () {

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
// SuperAdmin Routes
    Route::get('/Sa/dashboard', function () {
        return view('superadmin.dashboard');
    })->name('sa.dashboard');



// Admin Routes
    Route::get('/Ad/addtenant', function () {
        return view('admin.addtenant');
    })->name('ad.addtenant');

    Route::get('/Ad/dashboard',[AdminController::class,'index'])->name('ad.dashboard');
    Route::post('/Ad/addtenant',[AdminController::class,'addtnt'])->name('ad.addtnt');



// Tenant Routes
    Route::get('/Tn/dashboard', function () {
        return view('tenant.dashboard');
    })->name('tn.dashboard');
});
require __DIR__ . '/auth.php';
