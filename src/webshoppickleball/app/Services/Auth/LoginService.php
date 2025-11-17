<?php

namespace App\Services\Auth;

use App\Contracts\UserContract;
use App\Interfaces\UserRepositoryInterface;
use App\DTO\DataResult;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Exception;

class LoginService
{
    private UserRepositoryInterface $userRepository;
    private UserContract $userContract;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserContract $userContract
    ) {
        $this->userRepository = $userRepository;
        $this->userContract = $userContract;
    }

    public function login(string $email, string $password): DataResult
    {
        try {
            $user = $this->userRepository->findByEmail($email);
            $this->userContract->validateLogin($user, $password);

            $token = JWTAuth::fromUser($user);

            // Lưu token vào session nếu cần
            session(['jwt_token' => $token]);

            return new DataResult(
                'Đăng nhập thành công',
                200,
                [
                    'user' => $user,
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => JWTAuth::factory()->getTTL() * 60,
                ]
            );
        } catch (Exception $e) {
            return new DataResult($e->getMessage(), 400);
        }
    }

    public function me(): DataResult
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) throw new Exception("Token không hợp lệ hoặc hết hạn");

            return new DataResult('Thông tin user', 200, $user);
        } catch (Exception $e) {
            return new DataResult($e->getMessage(), 401);
        }
    }

    public function refresh(): DataResult
    {
        try {
            $token = JWTAuth::parseToken()->refresh();
            $user = JWTAuth::parseToken()->authenticate();

            return new DataResult(
                'Refresh token thành công',
                200,
                [
                    'user' => $user,
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => JWTAuth::factory()->getTTL() * 60,
                ]
            );
        } catch (Exception $e) {
            return new DataResult($e->getMessage(), 401);
        }
    }

    public function logout(): DataResult
    {
        try {
            JWTAuth::parseToken()->invalidate();
            return new DataResult('Đăng xuất thành công', 200);
        } catch (Exception $e) {
            return new DataResult($e->getMessage(), 400);
        }
    }
}
