<?php

namespace App\Interfaces;

interface CartItemRepositoryInterface extends BaseRepositoryInterface
{
    public function getByCartAndProduct($cartId, $productId);
}
