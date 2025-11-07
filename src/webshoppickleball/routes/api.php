<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/active', [RegisterController::class, 'active']);
Route::post('/resend-otp', [RegisterController::class, 'resendOtp']);

