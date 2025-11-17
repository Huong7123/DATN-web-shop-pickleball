<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\DTO\DataResult;
use App\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use Exception;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller{
    private LoginService $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request)
    {
        try {
            // Lấy dữ liệu từ request đã được validate
            $data = $request->validated();

            $resultData = $this->loginService->login($data['email'], $data['password']);

            $result = new DataResult(
                'Đăng nhập thành công',
                200,
                [
                    'user' => $resultData['user'],
                    'access_token' => $resultData['token'],
                    'token_type' => 'bearer',
                    'expires_in' => JWTAuth::factory()->getTTL() * 60,
                ]
            );
            return response()->json($result);
        } catch (Exception $e) {
            return response()->json(new DataResult(
                $e->getMessage(),
                400
            ),400);
        }

    }

    public function me()
    {
        try {
            $user = $this->loginService->me();
            return response()->json(new DataResult('Thông tin user', 200, $user));
        } catch (Exception $e) {
            return response()->json(new DataResult($e->getMessage(), 401), 401);
        }
    }

    // Refresh token
    public function refresh()
    {
        try {
            $data = $this->loginService->refresh();
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
            $this->loginService->logout();
            return response()->json(new DataResult('Đăng xuất thành công', 200));
        } catch (Exception $e) {
            return response()->json(new DataResult($e->getMessage(), 400), 400);
        }
    }
}