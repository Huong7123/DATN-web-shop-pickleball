<?php

namespace App\Interfaces;

interface AddressRepositoryInterface extends BaseRepositoryInterface
{
    public function resetDefault(int $userId): bool;
    
}
