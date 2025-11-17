<?php 

namespace App\Services\Auth;

use App\Contracts\UserContract;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Exception;

class LoginService {
    private UserRepositoryInterface $userRepository;
    private UserContract $userContract;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserContract $userContract
    )
    {
        $this->userRepository = $userRepository;
        $this->userContract = $userContract;
    }
    public function login(string $email, string $password): array
    {
        $user = $this->userRepository->findByEmail($email);
        
        $this->userContract->validateLogin($user, $password);

        $token = JWTAuth::fromUser($user);

        session(['jwt_token' => $token]);

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

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