<?php 

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Exception;

class AuthService {

    public function me(): User
    {
        $user = JWTAuth::parseToken()->authenticate();
        if (!$user) {
            throw new Exception("Token không hợp lệ hoặc hết hạn");
        }
        return $user;
    }

    // Refresh token
    public function refresh(): array
    {
        $token = JWTAuth::parseToken()->refresh();
        $user = JWTAuth::parseToken()->authenticate();

        return [
            'user' => $user,
            'token' => $token,
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ];
    }

    // Logout: vô hiệu hóa token hiện tại
    public function logout(): void
    {
        JWTAuth::parseToken()->invalidate();
    }
}