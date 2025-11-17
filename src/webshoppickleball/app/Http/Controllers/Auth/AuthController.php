<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\DTO\DataResult;
use App\Services\Auth\AuthService;
use Exception;

class AuthController extends Controller{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function me()
    {
        try {
            $user = $this->authService->me();
            return response()->json(new DataResult('Thông tin user', 200, $user));
        } catch (Exception $e) {
            return response()->json(new DataResult($e->getMessage(), 401), 401);
        }
    }

    // Refresh token
    public function refresh()
    {
        try {
            $data = $this->authService->refresh();
            return response()->json(new DataResult('Refresh token thành công', 200, [
                'user' => $data['user'],
                'access_token' => $data['token'],
                'token_type' => 'bearer',
                'expires_in' => $data['expires_in'],
            ]));
        } catch (Exception $e) {
            return response()->json(new DataResult($e->getMessage(), 401), 401);
        }
    }

    // Logout
    public function logout()
    {
        try {
            $this->authService->logout();
            return response()->json(new DataResult('Đăng xuất thành công', 200));
        } catch (Exception $e) {
            return response()->json(new DataResult($e->getMessage(), 400), 400);
        }
    }
}