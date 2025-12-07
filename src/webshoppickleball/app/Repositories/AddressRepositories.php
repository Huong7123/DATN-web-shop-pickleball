<?php

namespace App\Repositories;

use App\Interfaces\AddressRepositoryInterface;
use App\Models\Address;

class AddressRepositories extends BaseRepositories implements AddressRepositoryInterface
{
    public function __construct(Address $model)
    {
        parent::__construct($model);
    }

    public function resetDefault(int $userId): bool
    {
        return $this->model
            ->where('user_id', $userId)
            ->update(['is_default' => false]);
    }

}
