<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\AttributeValueController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\AddressController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\DiscountController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\CartController;
use App\Http\Controllers\Backend\ChatAIController;
use App\Http\Controllers\Backend\PaymentController;
use Illuminate\Http\Request;

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/active', [RegisterController::class, 'active']);
Route::post('/resend-otp', [RegisterController::class, 'resendOtp']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
Route::post('/reset-password', [ForgotPasswordController::class, 'ResetPassword']);

// Route::get('/vnpay/return', [PaymentController::class, 'returnVnpay'])->name('vnpay.return');
// Route::get('/vnpay/redirect', [PaymentController::class, 'redirectToVnpay'])->name('vnpay.redirect');

Route::get('/attribute', [AttributeController::class, 'index']);
Route::get('/attribute-value', [AttributeValueController::class, 'index']);
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/product', [ProductController::class, 'getParentProduct']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/products/related/{categoryId}/{productId}', [ProductController::class, 'getProductByCategory']);
Route::get('/product-child', [ProductController::class, 'getChildProduct']);
Route::post('/product-variant/{id}', [ProductController::class, 'getVariant']);

Route::post('/chatbot', ChatAIController::class);


Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);

    //quản lý sổ địa chỉ
    Route::get('/address', [AddressController::class, 'index']);
    Route::get('/address/{id}', [AddressController::class, 'show']);
    Route::post('/address', [AddressController::class, 'store']);
    Route::post('/address/{id}', [AddressController::class, 'update']);
    Route::delete('/address/{id}', [AddressController::class, 'destroy']);

    //payment vnpay
    Route::post('/vnpay/create', [PaymentController::class, 'createPayUrl'])->name('vnpay.create');

    // Quản lý người dùng
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::post('/user', [UserController::class, 'store']);
    Route::post('/user/{id}', [UserController::class, 'update']);
    Route::post('/user/update-pass/{id}', [UserController::class, 'updatePassword']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);

    //quản lý danh mục
    Route::post('/category', [CategoryController::class, 'store']);
    Route::post('/category/{id}', [CategoryController::class, 'update']);
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']);

    //quản lý sản phẩm
    Route::post('/product', [ProductController::class, 'store']);
    Route::post('/product/{id}', [ProductController::class, 'update']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);

    //quản lý đơn hàng
    Route::get('/order/user', [OrderController::class, 'getAllOrder']);
    Route::get('/order', [OrderController::class, 'getAllOrderAdmin']);
    Route::post('/order', [OrderController::class, 'store']);
    Route::post('/order/{id}', [OrderController::class, 'update']);
    Route::delete('/order/{id}', [OrderController::class, 'destroy']);

    //quản lý giỏ hàng
    Route::get('/cart/{userId}', [CartController::class, 'getCartItems']);
    Route::post('/cart', [CartController::class, 'store']);
    Route::post('/cart/{id}', [CartController::class, 'update']);
    Route::delete('/cart/{id}', [CartController::class, 'deleteItems']);

    // quản lý mã giảm giá
    Route::get('/discount', [DiscountController::class, 'index']);
    Route::post('/discount', [DiscountController::class, 'store']);
    Route::post('/discount/{id}', [DiscountController::class, 'update']);
    Route::delete('/discount/{id}', [DiscountController::class, 'destroy']);

    // quản lý bộ thuộc tính
    Route::post('/attribute', [AttributeController::class, 'store']);
    Route::post('/attribute/{id}', [AttributeController::class, 'update']);
    Route::delete('/attribute/{id}', [AttributeController::class, 'destroy']);

    // quản lý giá trị bộ thuộc tính
    Route::post('/attribute-value', [AttributeValueController::class, 'store']);
    Route::post('/attribute-value/{id}', [AttributeValueController::class, 'update']);
    Route::delete('/attribute-value/{id}', [AttributeValueController::class, 'destroy']);

});