<?php

namespace App\Interfaces;

interface CartItemRepositoryInterface extends BaseRepositoryInterface
{
    public function getByCartAndVariant($cartId, $variantId);
}
