<?php

namespace App\Interfaces;

use App\Models\Discount;

interface DiscountRepositoryInterface extends BaseRepositoryInterface
{
    // CRUD chung đã có trong BaseRepository, nên không cần khai báo lại

    // Các phương thức đặc thù của Category
    public function findByEmail(string $email): ?Discount;

    public function resendOtp(int $id, array $data): Discount;

    public function activateUser(int $userId, \DateTimeInterface $activatedAt): bool;

    public function updateOtpCode(int $userId, string $otp, \DateTime $expiresAt): bool;

    public function updatePassword(int $userId, string $hashedPassword): bool;
}
