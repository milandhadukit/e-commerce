<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;


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
Route::get('/razorpay-payment', [OrderController::class, 'index']);
Route::post('/razorpay-payment', [OrderController::class, 'orderPayment'])->name('razorpay.payment.store');


Route::get('/stripes', [PaymentController::class, 'index']);  //4000000000003220
Route::post('/payment', [PaymentController::class, 'payment']);



  

    Route::get('stripe',  [PaymentController::class, 'stripe']);
    Route::post('stripepost',  [PaymentController::class, 'stripePost'])->name('stripe.post');
