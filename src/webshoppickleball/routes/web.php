<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-create', [UserController::class, 'create']);

//Auth
Route::get('/register', function () {
    return view('layouts.Auth.Pages.register',['title' => 'Đăng ký']);
});

Route::get('/verify-otp', function () {
    return view('layouts.Auth.Pages.verify-otp',['title' => 'Xác thực OTP']);
});

Route::get('/login', function () {
    return view('layouts.Auth.Pages.login', ['title' => 'Đăng nhập']);
});

Route::get('/forgot-password', function () {
    return view('layouts.Auth.Pages.forgot-password', ['title' => 'Quên mật khẩu']);
});
Route::get('/reset-password', function () {
    return view('layouts.Auth.Pages.reset-password', ['title' => 'Đặt lại mật khẩu']);
});