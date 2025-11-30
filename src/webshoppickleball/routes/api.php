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
    Route::get('/list-user', [UserController::class, 'index']);
    Route::post('/add-user', [UserController::class, 'store']);
    Route::post('/update-user/{id}', [UserController::class, 'update']);
    Route::delete('/delete-user/{id}', [UserController::class, 'destroy']);

    //quản lý danh mục
    Route::get('/list-category', [CategoryController::class, 'index']);
    Route::post('/add-category', [CategoryController::class, 'store']);
    Route::post('/update-category/{id}', [CategoryController::class, 'update']);
    Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy']);

    //quản lý sản phẩm
    Route::get('/list-product', [ProductController::class, 'index']);
    Route::post('/add-product', [ProductController::class, 'store']);
    Route::post('/update-product/{id}', [ProductController::class, 'update']);
    Route::delete('/delete-product/{id}', [ProductController::class, 'destroy']);

    // quản lý mã giảm giá
    Route::get('/list-discount', [DiscountController::class, 'index']);
    Route::post('/add-discount', [DiscountController::class, 'store']);
    Route::post('/update-discount/{id}', [DiscountController::class, 'update']);
    Route::delete('/delete-discount/{id}', [DiscountController::class, 'destroy']);

    // quản lý bộ thuộc tính
    Route::get('/list-attribute', [AttributeController::class, 'index']);
    Route::post('/add-attribute', [AttributeController::class, 'store']);
    Route::post('/update-attribute/{id}', [AttributeController::class, 'update']);
    Route::delete('/delete-attribute/{id}', [AttributeController::class, 'destroy']);

    // quản lý giá trị bộ thuộc tính
    Route::get('/list-attribute-value', [AttributeValueController::class, 'index']);
    Route::post('/add-attribute-value', [AttributeValueController::class, 'store']);
    Route::post('/update-attribute-value/{id}', [AttributeValueController::class, 'update']);
    Route::delete('/delete-attribute-value/{id}', [AttributeValueController::class, 'destroy']);
});