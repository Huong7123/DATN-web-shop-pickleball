<?php

namespace App\Repositories;

use App\Interfaces\AttributeRepositoryInterface;
use App\Models\Attribute;

class AttributeRepositories extends BaseRepositories implements AttributeRepositoryInterface
{
    public function __construct(Attribute $model)
    {
        parent::__construct($model);
    }

}
