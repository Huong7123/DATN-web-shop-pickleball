<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\AttributeValueController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\DiscountController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\OrderController;
use Illuminate\Http\Request;

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/active', [RegisterController::class, 'active']);
Route::post('/resend-otp', [RegisterController::class, 'resendOtp']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
Route::post('/reset-password', [ForgotPasswordController::class, 'ResetPassword']);


Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Quản lý người dùng
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user', [UserController::class, 'store']);
    Route::post('/user/{id}', [UserController::class, 'update']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);

    //quản lý danh mục
    Route::get('/category', [CategoryController::class, 'index']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::post('/category/{id}', [CategoryController::class, 'update']);
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']);

    //quản lý sản phẩm
    Route::get('/product', [ProductController::class, 'index']);
    Route::post('/product', [ProductController::class, 'store']);
    Route::post('/product/{id}', [ProductController::class, 'update']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);

    //quản lý đơn hàng
    Route::get('/order', [OrderController::class, 'index']);
    Route::post('/order', [OrderController::class, 'store']);
    Route::post('/order/{id}', [OrderController::class, 'update']);
    Route::delete('/order/{id}', [OrderController::class, 'destroy']);

    // quản lý mã giảm giá
    Route::get('/discount', [DiscountController::class, 'index']);
    Route::post('/discount', [DiscountController::class, 'store']);
    Route::post('/discount/{id}', [DiscountController::class, 'update']);
    Route::delete('/discount/{id}', [DiscountController::class, 'destroy']);

    // quản lý bộ thuộc tính
    Route::get('/attribute', [AttributeController::class, 'index']);
    Route::post('/attribute', [AttributeController::class, 'store']);
    Route::post('/attribute/{id}', [AttributeController::class, 'update']);
    Route::delete('/attribute/{id}', [AttributeController::class, 'destroy']);

    // quản lý giá trị bộ thuộc tính
    Route::get('/attribute-value', [AttributeValueController::class, 'index']);
    Route::post('/attribute-value', [AttributeValueController::class, 'store']);
    Route::post('/attribute-value/{id}', [AttributeValueController::class, 'update']);
    Route::delete('/attribute-value/{id}', [AttributeValueController::class, 'destroy']);
});