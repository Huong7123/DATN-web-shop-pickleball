<?php

namespace App\Repositories;

use App\Interfaces\AttributeRepositoryInterface;
use App\Models\Category;

class AttributeRepositories extends BaseRepositories implements AttributeRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

}
