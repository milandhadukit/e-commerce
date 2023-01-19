<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\CategoryandProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\CustomerReviewController;
use App\Http\Controllers\Admin\ReviewCustomerController;
use Illuminate\Support\Facades\Auth;


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




 // web 
 Route::get('/logouts', [AuthController::class, 'logout'])->name('logouts');
 Route::get('/user-profile', [AuthController::class, 'userProfile'])->name('profile');   
 Route::get('/login',  [AuthController::class, 'loginView'])->name('login');
 Route::post('/logins',  [AuthController::class, 'login'])->name('login.user');

 Route::post('/add-order', [OrderController::class, 'addOrder'])->name('store.order');


 Route::get('/view-product',  [CategoryandProductController::class, 'viewProduct'])->name('view.product');
 Route::post('/store-cart', [CartController::class, 'addToCart'])->name('store.cart');

 Route::get('/add-details', [OrderController::class, 'addOrderDetails'])->name('add-detail');
 
 Route::post('/store-details', [UserDetailController::class, 'addUserDetails'])->name('store.detail');
 Route::get('/view-details', [UserDetailController::class, 'viewOrderDetailsUser'])->name('view.detail');
 Route::get('/edit-address/{id}', [UserDetailController::class, 'editAddress'])->name('edit-address');
 Route::post('/update-address/{id}', [UserDetailController::class, 'updateUserDetails'])->name('update-address');


 Route::get('/payment-details-add', [PaymentController::class, 'paymentAdd'])->name('payment-detail');
 Route::post('/add-payment', [PaymentController::class, 'payment'])->name('payment');

 Route::get('/view-cart', [CartController::class, 'viewCart'])->name('view-cart');
 Route::post('/remove-cart/{id}', [CartController::class, 'removeCart'])->name('remove-cart');
 Route::get('/edit-cart/{id}', [CartController::class, 'editCart'])->name('edit-cart');
 Route::post('/update-cart/{id}', [CartController::class, 'updateToCart'])->name('update-cart');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
