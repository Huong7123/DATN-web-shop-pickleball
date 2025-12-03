<?php

namespace App\Interfaces;

interface CartRepositoryInterface extends BaseRepositoryInterface
{
    public function getByUserId(int $userId);
}
