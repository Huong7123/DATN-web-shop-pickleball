<?php 

namespace App\Services\Auth;

use App\Interfaces\Mail\MailServiceInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Exception;

class ResgiterService {
    private UserRepositoryInterface $userRepository;
    private MailServiceInterface $mailService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        MailServiceInterface $mailService
    )
    {
        $this->userRepository = $userRepository;
        $this->mailService = $mailService;
    }

    public function register(array $data){
        $otp = random_int(100000, 999999);

        $data =[
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

        // Lưu user vào DB
        $savedUser = $this->userRepository->save($data);
        // Gửi OTP qua email
        $this->mailService->sendOtp($savedUser->email, $otp);

        return $savedUser;
    }

    public function resendOtp(string $email){
        $user = $this->userRepository->findByEmail($email);
        
        $otp = random_int(100000, 999999);

        $data =[
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ];

        // Gửi OTP qua email
        $this->mailService->sendOtp($user->email, $otp);

        $resendOtp = $this->userRepository->resendOtp($user->id, $data);

        return $resendOtp;
    }

    public function active(string $email, string $otp): bool{
        $user = $this->userRepository->findByEmail($email);
        if (!$user) {
            throw new \Exception('Không tìm thấy người dùng');
        }

        if ($user->otp_code !== $otp || !$user->otp_expires_at || $user->otp_expires_at->isPast()) {
            return false;
        }

        return $this->userRepository->activateUser($user->id,now());
    }
}