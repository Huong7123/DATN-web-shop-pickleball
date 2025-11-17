<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
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
});