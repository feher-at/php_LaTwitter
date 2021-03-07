<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicItemController;
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



//Admin product controller's routes

Route::get('/products', [AdminItemController::class,'getIndex'])->name('products');
Route::get('/get-data-for-table',[AdminItemController::class, 'getData']);
Route::get('/new-item',[AdminItemController::class,'getNewItemPage']);
Route::post('/new-item',[AdminItemController::class,'createOrUpdateItem'])->name('new-item');
Route::get('/delete-item',[AdminItemController::class,'deleteProduct']);

Route::get('/handling-users','UserHandlingController@showUserHandlingPage')->name('handling-users');

// Public product controller's routes

Route::get('/products/public', [PublicItemController::class,'getIndex'])->name('products/public');
Route::get('/ajax-get-data-for-public-table',[PublicItemController::class, 'getData']);

// Order controller's routes

Route::get('/order-item',[OrderController::class,'getOrderPage']);
Route::post('/order-summary',[OrderController::class,'getOrderSummaryPage']);
Route::post('/order-item',[OrderController::class,'createOrder']);
Route::post('/back-to-order-page',[OrderController::class,'getOrderPage']);
Route::get('/orders',[OrderController::class, 'getOrderListPage'])->name('orders');
Route::get('/ajax-get-orders',[OrderController::class, 'getData']);
Route::get('/ajax-delete-order',[OrderController::class, 'deleteOrder']);
Route::get('/ajax-change-status',[OrderController::class, 'changeStatus']);

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');


