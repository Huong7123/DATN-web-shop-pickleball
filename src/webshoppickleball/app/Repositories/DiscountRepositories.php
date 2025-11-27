<?php

namespace App\Repositories;

use App\Interfaces\DiscountRepositoryInterface;
use App\Models\Discount;

class DiscountRepositories extends BaseRepositories implements DiscountRepositoryInterface
{
    public function __construct(Discount $model)
    {
        parent::__construct($model);
    }

}
