<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepositories implements UserRepositoryInterface {

    public function save($user)
    {
        return User::create($user);
    }

    public function resendOtp(int $id, array $data): User
    {
        $user = User::where('id', $id)
                ->where('status', 0)
                ->firstOrFail();
        $user->update($data);
        return $user->fresh();
    }

    public function findByEmail(string $email)
    {   
        return User::where('email', $email)->first();
    }

    public function activateUser(int $userId, \DateTimeInterface $activatedAt):bool
    {
        return (bool)User::where('id', $userId)->update([
            'status' => 1,
            'email_verified_at'  => $activatedAt,
            'otp_code' => null,
            'otp_expires_at' => null
        ]);
    }

    public function updateOtpCode(int $userId, string $otp, \DateTime $expiresAt):bool
    {
        return (bool)User::where('id', $userId)->update([
            'status' => 0,
            'otp_code' => $otp,
            'otp_expires_at' => $expiresAt
        ]);
    }

    public function updatePassword(int $userId, string $hashedPassword):bool
    {
        return (bool)User::where('id', $userId)->update([
            'status' => 1,
            'password' => $hashedPassword,
            'otp_code' => null,
            'otp_expires_at' => null
        ]);
    }
}
