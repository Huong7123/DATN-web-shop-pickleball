<?php

namespace App\Repositories;

use App\Interfaces\CartRepositoryInterface;
use App\Models\Cart;

class CartRepositories extends BaseRepositories implements CartRepositoryInterface
{
    public function __construct(Cart $model)
    {
        parent::__construct($model);
    }

    public function getByUserId(int $userId)
    {
        return $this->model->where('user_id', $userId)
            ->first();
    }

}
