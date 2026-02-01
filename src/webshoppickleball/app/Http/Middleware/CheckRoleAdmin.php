<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class CheckRoleAdmin
{
    public function handle($request, Closure $next)
    {
        try {
            // Lấy token từ Laravel request hoặc trực tiếp từ PHP siêu biến (dùng cho Docker)
            $token = $request->cookie('admin_token') ?? ($_COOKIE['admin_token'] ?? null);

            if (!$token) {
                return redirect()->route('login');
            }

            // Xác thực token
            $user = JWTAuth::setToken($token)->authenticate();

            // Kiểm tra role: Chú ý ép kiểu (int) để so sánh chính xác nhất
            if (!$user || (int)$user->role !== 2) {
                // Nếu là tài khoản user (role 1) nhưng vào route admin
                return redirect()->route('login')->with('error', 'Bạn không có quyền admin');
            }

            // Đăng nhập user vào hệ thống để có thể dùng Auth::user()
            Auth::guard('api')->setUser($user);

        } catch (\Exception $e) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
