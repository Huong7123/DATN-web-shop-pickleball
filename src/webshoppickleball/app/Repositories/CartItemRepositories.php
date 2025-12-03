<?php

namespace App\Repositories;

use App\Interfaces\CartItemRepositoryInterface;
use App\Models\CartItem;

class CartItemRepositories extends BaseRepositories implements CartItemRepositoryInterface
{
    public function __construct(CartItem $model)
    {
        parent::__construct($model);
    }

    public function getByCartAndVariant($cartId, $variantId)
    {
        return $this->model
            ->where('cart_id', $cartId)
            ->where('product_variant_id', $variantId)
            ->first();
    }

}
