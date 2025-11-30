<?php

namespace App\Repositories;

use App\Interfaces\AttributeValueRepositoryInterface;
use App\Models\AttributeValue;

class AttributeValueRepositories extends BaseRepositories implements AttributeValueRepositoryInterface
{
    public function __construct(AttributeValue $model)
    {
        parent::__construct($model);
    }

}
