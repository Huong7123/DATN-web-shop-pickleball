<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    // CRUD chung đã có trong BaseRepository, nên không cần khai báo lại

    // Các phương thức đặc thù của User
    public function findByEmail(string $email): ?User;

    public function resendOtp(int $id, array $data): User;

    public function activateUser(int $userId, \DateTimeInterface $activatedAt): bool;

    public function updateOtpCode(int $userId, string $otp, \DateTime $expiresAt): bool;

    public function updatePassword(int $userId, string $hashedPassword): bool;
}
