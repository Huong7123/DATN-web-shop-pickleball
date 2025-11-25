<?php

namespace App\Http\Middleware;

use Closure;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class CheckRoleAdmin
{
    public function handle($request, Closure $next)
    {
        try {
            $token = $request->cookie('admin_token'); // Lấy token từ cookie
            if (!$token) {
                return response()->json("Token không hợp lệ hoặc hết hạn");
            }

            $user = JWTAuth::setToken($token)->authenticate();

            if (!$user || $user->role !== '2') {
                return response()->json("Token không hợp lệ hoặc hết hạn");
            }
        } catch (\Exception $e) {
            return response()->json("Token không hợp lệ hoặc hết hạn");
        }

        return $next($request);

    }
}
