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

    public function updateStatusByAttributeId(int $attributeId)
    {
        return $this->model
            ->where('attribute_id', $attributeId)
            ->update([
                'status' => 0
            ]);
    }

}
