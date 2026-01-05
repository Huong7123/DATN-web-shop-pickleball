<?php

namespace App\Interfaces;

interface OrderRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllOrder(array $filters);
    public function getOrderDetail(int $id);
}
