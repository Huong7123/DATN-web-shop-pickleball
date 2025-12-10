<?php

namespace App\Interfaces;

interface VnPayRepositoryInterface extends BaseRepositoryInterface
{
    public function findByTransactionId(string $transactionId);
}
