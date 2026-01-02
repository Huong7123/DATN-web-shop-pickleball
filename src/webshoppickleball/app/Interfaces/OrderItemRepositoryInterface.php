<?php

namespace App\Interfaces;

interface OrderItemRepositoryInterface extends BaseRepositoryInterface
{
    public function deleteByOrderId(int $orderId);
    public function getByOrder(int $orderId);
}
