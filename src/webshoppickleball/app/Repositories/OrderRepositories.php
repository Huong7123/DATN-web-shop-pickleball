<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepositories extends BaseRepositories implements OrderRepositoryInterface
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function getAllOrder(array $filters)
    {
        $query = $this->model->where('user_id', $filters['user_id']);
        $query->when(!empty($filters['status']), function ($q) use ($filters) {
            $q->where('status', $filters['status']);
        });
        return $query->get();
    }

    public function getOrderDetail(int $id)
    {
        return $this->model->with('items.product.attributeValues')->where('id', $id)->first();
    }
}
