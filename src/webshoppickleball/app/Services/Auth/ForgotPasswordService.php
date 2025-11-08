<?php 

namespace App\Services\Auth;

use App\Contracts\UserContract;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\Mail\MailServiceInterface;
use Illuminate\Support\Facades\Hash;
use Exception;

class ForgotPasswordService {
    private UserRepositoryInterface $userRepository;
    private UserContract $userContract;
    private MailServiceInterface $mailService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserContract $userContract,
        MailServiceInterface $mailService
    )
    {
        $this->userRepository = $userRepository;
        $this->userContract = $userContract;
        $this->mailService = $mailService;
    }
    public function forgotPassword(string $email): array
    {
        $otp = random_int(100000, 999999);
        $otp_expires_at = now()->addMinutes(5);
        $user = $this->userRepository->findByEmail($email);
        
        $this->userContract->validateForgot($user);

        $this->mailService->sendOtp($user->email, $otp);
        $this->userRepository->updateOtpCode($user->id,$otp,$otp_expires_at);
        return [
            'user'  => $user,
        ];
    }
    public function ResetPassword(string $email, string $newPassword): bool
    {
        $user = $this->userRepository->findByEmail($email);
        if (!$user) {
            throw new Exception("Người dùng không tồn tại");
        }
        $hashedPassword = Hash::make($newPassword);
        return $this->userRepository->updatePassword($user->id, $hashedPassword);
    }
}