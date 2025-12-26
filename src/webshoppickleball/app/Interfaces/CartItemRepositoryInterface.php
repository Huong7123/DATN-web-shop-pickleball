<?php

namespace App\Interfaces;

interface CartItemRepositoryInterface extends BaseRepositoryInterface
{
    public function getByCartAndProduct($cartId, $productId);

    function findVariant(int $parentId, array $selectedValueIds);

    public function deleteItems(int $id);
}
