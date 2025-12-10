<?php

namespace App\Repositories;

use App\Interfaces\VnPayRepositoryInterface;
use App\Models\PaymentTransaction;

class VnPayRepositories extends BaseRepositories implements VnPayRepositoryInterface
{
    public function __construct(PaymentTransaction $model)
    {
        parent::__construct($model);
    }

    public function findByTransactionId(string $transactionId)
    {
        return $this->model->where('transaction_id', $transactionId)->first();
    }

}
