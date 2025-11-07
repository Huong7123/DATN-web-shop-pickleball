<?php

namespace App\Interfaces;

use App\Core\Domain\Entities\UserEntity;
use Illuminate\Support\Collection;
use App\Models\User;

interface UserRepositoryInterface {

    public function save($user);
    public function findByEmail(string $email);
    public function activateUser(int $userId, \DateTimeInterface $activatedAt):bool;
    public function resendOtp(int $id, array $data): User;
}
