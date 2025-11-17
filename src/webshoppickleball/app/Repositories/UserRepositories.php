<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepositories extends BaseRepositories implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }

    public function resendOtp(int $id, array $data): User
    {
        $user = $this->model->where('id', $id)
            ->where('status', 0)
            ->firstOrFail();
        $user->update($data);
        return $user->fresh();
    }

    public function activateUser(int $userId, \DateTimeInterface $activatedAt): bool
    {
        return (bool)$this->model->where('id', $userId)->update([
            'status' => 1,
            'email_verified_at' => $activatedAt,
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);
    }

    public function updateOtpCode(int $userId, string $otp, \DateTime $expiresAt): bool
    {
        return (bool)$this->model->where('id', $userId)->update([
            'status' => 0,
            'otp_code' => $otp,
            'otp_expires_at' => $expiresAt,
        ]);
    }

    public function updatePassword(int $userId, string $hashedPassword): bool
    {
        return (bool)$this->model->where('id', $userId)->update([
            'status' => 1,
            'password' => $hashedPassword,
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);
    }
}
