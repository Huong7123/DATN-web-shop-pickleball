<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $token = session('jwt_token'); // lấy token từ session server

        dd($token);

        if (!$token) {
            return redirect()->route('admin.login')
                             ->with('error', 'Vui lòng đăng nhập');
        }

        try {
            $user = JWTAuth::setToken($token)->authenticate();
        } catch (\Exception $e) {
            return redirect()->route('admin.login')
                             ->with('error', 'Token không hợp lệ hoặc hết hạn');
        }

        if ($user->role != $role) {
            return redirect()->route('admin.login')
                             ->with('error', 'Không có quyền truy cập');
        }

        // Gán user vào request để dùng trong controller
        $request->merge(['user' => $user]);

        return $next($request);
    }
}
