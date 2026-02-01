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
                return redirect()->route('login');
            }

            $user = JWTAuth::setToken($token)->authenticate();

            if (!$user || $user->role !== '2') {
                return redirect()->route('login');
            }
        } catch (\Exception $e) {
            return redirect()->route('login');
        }

        return $next($request);

    }
}
