<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\CategoryandProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\OrderAdminController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'middleware' => 'api',
    // 'prefix' => 'auth'
], function ($router) {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    

    Route::post('/add-category', [CategoryController::class, 'addCategory']);
    Route::post('/update-category/{id}', [CategoryController::class, 'updateCategory']);
    Route::post('/delete-category/{id}', [CategoryController::class, 'deleteCategory']);
    Route::get('/list-category', [CategoryController::class, 'categoryLOV']);

    Route::post('/add-product', [ProductController::class, 'addProduct']);
    Route::post('/update-product/{id}', [ProductController::class, 'updateProduct']);
    Route::delete('/delete-product/{id}', [ProductController::class, 'deleleProduct']);
    Route::get('/view-product-category/{id}', [ProductController::class, 'viewProductByCategory']);

    Route::post('/view-order-list', [OrderAdminController::class, 'orderList']);
    Route::post('/view-cencel-list', [OrderAdminController::class, 'orderCancelList']);
    Route::get('/view-search-list', [OrderAdminController::class, 'serchOrder']);







    Route::post('/add-details', [UserDetailController::class, 'addUserDetails']);

    #view category,product and productview based on category without login  
    Route::get('/view-category', [CategoryandProductController::class, 'viewCategory']);
    Route::get('/view-product', [CategoryandProductController::class, 'viewProduct']);
    Route::get('/view-product-category/{id}', [CategoryandProductController::class, 'viewProducOnCategory']);

    Route::post('/add-cart', [CartController::class, 'addToCart']);
    Route::get('/view-cart', [CartController::class, 'viewCart']);
    Route::post('/remove-cart/{id}', [CartController::class, 'removeCart']);

    Route::post('/add-order', [OrderController::class, 'addOrder']);
    Route::post('/cencel-order/{id}', [OrderController::class, 'cancelOrder']);
    Route::post('/my-order', [OrderController::class, 'myOrder']);

   

    Route::post('/add-payment', [PaymentController::class, 'payment']);
    // https://www.ultimateakash.com/blog-details/IixTJGAKYAo=/How-to-Integrate-Stripe-Payment-Gateway-In-Laravel-2022





});