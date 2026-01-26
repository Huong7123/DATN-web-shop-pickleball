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

}
