<?php

namespace App\Interfaces;

interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllOrderAdmin($perPage, $status, $orderId);
    public function getAllOrder(array $filters);
    public function getOrderDetail(int $id);
}
