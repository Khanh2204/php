<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/changeLang/{lang}', function($lang){
    // session()->set('lang',$lang);
    $_SESSION['locale'] = $lang;
    return redirect()->route('office.index');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/admin/office',\App\Http\Controllers\OfficeController::class)->middleware('auth');
Route::resource('/admin/emplayee',\App\Http\Controllers\EmployeeController::class)->middleware('auth');
Route::resource('/admin/customer',\App\Http\Controllers\CustomerController::class)->middleware('auth');
Route::resource('/admin/payment',\App\Http\Controllers\PaymentController::class)->middleware('auth');
Route::resource('/admin/order',\App\Http\Controllers\OrderController::class)->middleware('auth');
Route::resource('/admin/orderdetail',\App\Http\Controllers\OrderdetailController::class)->middleware('auth');
Route::resource('/admin/product',\App\Http\Controllers\ProductController::class)->middleware('auth');
Route::resource('/admin/productline',\App\Http\Controllers\ProductlineController::class)->middleware('auth');
