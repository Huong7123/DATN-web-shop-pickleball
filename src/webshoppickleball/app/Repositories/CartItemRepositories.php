<?php

namespace App\Repositories;

use App\Interfaces\CartItemRepositoryInterface;
use App\Models\CartItem;
use App\Models\Product;

class CartItemRepositories extends BaseRepositories implements CartItemRepositoryInterface
{
    public function __construct(CartItem $model)
    {
        parent::__construct($model);
    }

    public function getByCartAndProduct($cartId, $productId)
    {
        return $this->model
            ->where('cart_id', $cartId)
            ->where('product_id', $productId)
            ->first();
    }

    function findVariant(int $parentId, array $selectedValueIds)
    {
        $count = count($selectedValueIds);

        return Product::query()
            ->where('parent_id', $parentId)
            ->whereIn('id', function ($q) use ($selectedValueIds, $count) {
                $q->select('product_id')
                    ->from('product_attribute_values')
                    ->groupBy('product_id')
                    ->havingRaw('COUNT(DISTINCT attribute_value_id) = ?', [$count]) // tổng attribute của variant
                    ->havingRaw(
                        'SUM(attribute_value_id IN (' . implode(',', $selectedValueIds) . ')) = ?',
                        [$count]
                    );
            })
            ->first();
    }

    public function deleteItems(int $id)
    {
        $record = $this->getById($id);
        if ($record) {
            return $record->delete();
        }
        return false;
    }


}
