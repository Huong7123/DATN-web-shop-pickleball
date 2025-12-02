<?php

namespace App\Interfaces;

interface OrderItemRepositoryInterface extends BaseRepositoryInterface
{
    public function deleteByOrderId(int $orderId);
}
