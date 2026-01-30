<?php

namespace App\Repositories;

use App\Interfaces\ExclusiveConfigRepositoryInterface;
use App\Models\ExclusiveConfig;

class ExclusiveConfigRepositories extends BaseRepositories implements ExclusiveConfigRepositoryInterface
{
    public function __construct(ExclusiveConfig $model)
    {
        parent::__construct($model);
    }

    public function getActiveConfigsWithDiscounts()
    {
        return ExclusiveConfig::with('discounts')
            ->where('status', 1)
            ->orderBy('min_spending', 'desc') // Sắp xếp từ cao xuống thấp để ưu tiên hạng cao
            ->get();
    }

}
