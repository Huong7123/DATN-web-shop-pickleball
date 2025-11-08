<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\DTO\DataResult;
use App\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use Exception;

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

            $user = $this->loginService->login($data['email'], $data['password']);
            $result = new DataResult(
                'Đăng nhập thành công',
                200,
                $user
            );
            return response()->json($result);
        } catch (Exception $e) {
            return response()->json(new DataResult(
                $e->getMessage(),
                400
            ),400);
        }

    }
}