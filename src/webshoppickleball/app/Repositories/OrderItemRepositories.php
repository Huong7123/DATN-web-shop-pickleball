<?php

namespace App\Repositories;

use App\Interfaces\OrderItemRepositoryInterface;
use App\Models\OrderItem;

class OrderItemRepositories extends BaseRepositories implements OrderItemRepositoryInterface
{
    public function __construct(OrderItem $model)
    {
        parent::__construct($model);
    }

    public function deleteByOrderId(int $orderId)
    {
        return $this->model->where('order_id', $orderId)->delete();
    }

}
