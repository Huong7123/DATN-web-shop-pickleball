<?php

namespace App\Services\Auth;

use App\Contracts\UserContract;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\Mail\MailServiceInterface;
use App\DTO\DataResult;
use Illuminate\Support\Facades\Hash;
use Exception;

class ForgotPasswordService
{
    private UserRepositoryInterface $userRepository;
    private UserContract $userContract;
    private MailServiceInterface $mailService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserContract $userContract,
        MailServiceInterface $mailService
    ) {
        $this->userRepository = $userRepository;
        $this->userContract = $userContract;
        $this->mailService = $mailService;
    }

    public function forgotPassword(string $email): DataResult
    {
        try {
            $user = $this->userRepository->findByEmail($email);
            $this->userContract->validateForgot($user);

            $otp = random_int(100000, 999999);
            $otp_expires_at = now()->addMinutes(5);

            // Lưu OTP vào user
            $this->userRepository->updateOtpCode($user->id, $otp, $otp_expires_at);

            // Gửi OTP qua email
            $this->mailService->sendOtp($user->email, $otp);

            return new DataResult(
                'Chúng tôi đã gửi mã OTP. Vui lòng kiểm tra email.',
                200,
                ['user' => $user]
            );
        } catch (Exception $e) {
            return new DataResult($e->getMessage(), 400);
        }
    }

    public function resetPassword(string $email, string $newPassword): DataResult
    {
        try {
            $user = $this->userRepository->findByEmail($email);
            if (!$user) {
                throw new Exception("Người dùng không tồn tại");
            }

            $hashedPassword = Hash::make($newPassword);
            $success = $this->userRepository->updatePassword($user->id, $hashedPassword);

            return new DataResult(
                'Đổi mật khẩu thành công',
                200,
                ['success' => $success]
            );
        } catch (Exception $e) {
            return new DataResult($e->getMessage(), 400);
        }
    }
}
