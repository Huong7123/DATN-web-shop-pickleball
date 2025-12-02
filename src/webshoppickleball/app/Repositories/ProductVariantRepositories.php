<?php

namespace App\Repositories;

use App\Interfaces\ProductVariantRepositoryInterface;
use App\Models\ProductVariant;

class ProductVariantRepositories extends BaseRepositories implements ProductVariantRepositoryInterface
{
    public function __construct(ProductVariant $model)
    {
        parent::__construct($model);
    }

}
