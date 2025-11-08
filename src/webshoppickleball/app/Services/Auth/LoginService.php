<?php 

namespace App\Services\Auth;

use App\Contracts\UserContract;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
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
        
        return [
            'user'  => $user,
        ];
    }
}