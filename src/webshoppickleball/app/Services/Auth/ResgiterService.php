<?php

namespace App\Services\Auth;

use App\Interfaces\Mail\MailServiceInterface;
use App\Interfaces\UserRepositoryInterface;
use App\DTO\DataResult;
use Illuminate\Support\Facades\Hash;
use Exception;

class ResgiterService
{
    private UserRepositoryInterface $userRepository;
    private MailServiceInterface $mailService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        MailServiceInterface $mailService
    ) {
        $this->userRepository = $userRepository;
        $this->mailService = $mailService;
    }

    public function register(array $data): DataResult
    {
        try {
            $otp = random_int(100000, 999999);

            $userData = [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'role' => $data['role'] ?? 1,
                'password' => Hash::make($data['password']),
                'email_verified_at' => null,
                'status' => 0,
                'otp_code' => $otp,
                'otp_expires_at' => now()->addMinutes(5),
            ];

            $savedUser = $this->userRepository->create($userData);

            // Gửi OTP
            $this->mailService->sendOtp($savedUser->email, $otp);

            return new DataResult(
                'Đăng ký thành công. Vui lòng kiểm tra email để nhận OTP.',
                201,
                $savedUser
            );
        } catch (\Exception $e) {
            return new DataResult($e->getMessage(), 400, null);
        }
    }

    public function resendOtp(string $email): DataResult
    {
        try {
            $user = $this->userRepository->findByEmail($email);
            if (!$user) {
                return new DataResult("Người dùng không tồn tại", 404);
            }

            $otp = random_int(100000, 999999);
            $data = [
                'otp_code' => $otp,
                'otp_expires_at' => now()->addMinutes(5),
            ];

            $updatedUser = $this->userRepository->resendOtp($user->id, $data);

            // Gửi OTP
            $this->mailService->sendOtp($user->email, $otp);

            return new DataResult(
                'Chúng tôi đã gửi mã OTP tới email của bạn!',
                200,
                $updatedUser
            );
        } catch (\Exception $e) {
            return new DataResult($e->getMessage(), 400, null);
        }
    }

    public function active(string $email, string $otp): DataResult
    {
        try {
            $user = $this->userRepository->findByEmail($email);
            if (!$user) {
                return new DataResult("Người dùng không tồn tại", 404);
            }

            if ($user->otp_code !== $otp || !$user->otp_expires_at || $user->otp_expires_at->isPast()) {
                return new DataResult("OTP không hợp lệ hoặc đã hết hạn", 400);
            }

            $success = $this->userRepository->activateUser($user->id, now());
            if ($success) {
                return new DataResult("Kích hoạt tài khoản thành công!", 200, $user);
            }

            return new DataResult("Kích hoạt thất bại", 400, null);
        } catch (\Exception $e) {
            return new DataResult($e->getMessage(), 400, null);
        }
    }
}
