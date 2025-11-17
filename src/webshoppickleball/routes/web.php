<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-create', [UserController::class, 'create']);

//Auth
Route::get('/register', function () {
    return view('layouts.Auth.pages.register',['title' => 'Đăng ký']);
});

Route::get('/verify-otp', function () {
    return view('layouts.Auth.pages.verify-otp',['title' => 'Xác thực OTP']);
});

Route::get('/login', function () {
    return view('layouts.Auth.pages.login', ['title' => 'Đăng nhập']);
})->name('login');

Route::get('/forgot-password', function () {
    return view('layouts.Auth.pages.forgot-password', ['title' => 'Quên mật khẩu']);
});
Route::get('/reset-password', function () {
    return view('layouts.Auth.pages.reset-password', ['title' => 'Đặt lại mật khẩu']);
});

//routes admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Các route bên trong
    Route::get('/login', function () {
        return view('layouts.Backend.login',['title' => 'Đăng nhập']);
    })->name('admin.login');
    
    Route::get('/user', function () {
        return view('layouts.Backend.pages.user',['title' => 'Quản lý người dùng']);
    });
    
});