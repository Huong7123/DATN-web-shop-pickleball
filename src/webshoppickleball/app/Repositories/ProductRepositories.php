<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Models\ProductVariant;

class ProductRepositories extends BaseRepositories implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function createVariant(array $variantData)
    {
        return ProductVariant::create($variantData);
    }

    /**
     * Gán attributes cho sản phẩm
     */
    public function attachAttributes($productId, array $attributeIds)
    {
        $product = $this->model->findOrFail($productId);
        return $product->attributes()->sync($attributeIds);
    }

    /**
     * Gán attribute values cho sản phẩm (nếu cần)
     */
    public function attachAttributeValues($productId, array $valueIds)
    {
        $product = $this->model->findOrFail($productId);
        return $product->attributeValues()->sync($valueIds);
    }

    /**
     * Gán attribute values cho biến thể (thay cho createVariantValue)
     */
    public function attachVariantValues(int $variantId, array $valueIds)
    {
        $variant = ProductVariant::findOrFail($variantId);
        return $variant->values()->sync($valueIds);
    }

    /**
     * Xóa biến thể
     */
    public function deleteVariant(int $variantId): bool
    {
        $variant = ProductVariant::find($variantId);
        if (!$variant) return false;
        return $variant->delete();
    }

    /**
     * Hủy gán attributes của sản phẩm
     */
    public function detachAttributes(int $productId): bool
    {
        $product = $this->model->find($productId);
        if (!$product) return false;
        $product->attributes()->detach();
        return true;
    }

    /**
     * Hủy gán attribute values của sản phẩm
     */
    public function detachAttributeValues(int $productId): bool
    {
        $product = $this->model->find($productId);
        if (!$product) return false;
        $product->attributeValues()->detach();
        return true;
    }

    public function getParentProduct($perPage, $keyword, $status, $minPrice, $maxPrice, $categoryIds)
    {
        return $this->model
            ->with([
                'category',
                'attributes',
                'attributeValues',
            ])
            ->where('parent_id', 0)
            ->when($keyword, function ($q) use ($keyword) {
                $q->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->when($status != -1, function ($q) use ($status) {
                if ($status == 0) {
                    $q->where('quantity', 0);
                }

                if ($status == 1) {
                    $q->whereBetween('quantity', [1, 5]);
                }

                if ($status == 2) {
                    $q->where('quantity', '>', 5);
                }
            })
            ->when(is_array($categoryIds), function ($q) use ($categoryIds) {
                $q->whereHas('category', function ($cat) use ($categoryIds) {
                    $cat->whereIn('id', $categoryIds);
                });
            })

            // Lọc theo giá
            ->when($minPrice !== null, function ($q) use ($minPrice) {
                $q->where('price', '>=', $minPrice);
            })
            ->when($maxPrice !== null, function ($q) use ($maxPrice) {
                $q->where('price', '<=', $maxPrice);
            })
            ->paginate($perPage);
    }

    public function getChildProduct($parentId)
    {
        return $this->model
            ->with([
                'category',
                'attributes',
                'attributeValues',
            ])
            ->where('parent_id', $parentId)
            ->get();
    }

    public function getProductBySlug($slug)
    {
        return $this->model
            ->with([
                'category',
                'attributes',
                'attributeValues',
            ])
            ->where('slug', $slug)
            ->first();
    }

    public function getProductByCategory($categoryId, $productId)
    {
        return $this->model
            ->where('parent_id', 0)
            ->where('category_id', $categoryId)
            ->where('id', '!=', $productId)
            ->limit(4)
            ->get();
    }

    public function sumVariantQuantity(int $parentId): int
    {
        return $this->model
            ->where('parent_id', $parentId)
            ->sum('quantity');
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

    public function delete(int $id)
    {
        $record = $this->getById($id);
        if (!$record) {
            return false;
        }
        $this->model
            ->where('parent_id', $id)
            ->delete();

        return $record->delete();
    }

    // trừ kho
    public function decrementStock(int $productId, int $qty): bool
    {
        return $this->model
            ->where('id', $productId)
            ->where('quantity', '>=', $qty)
            ->decrement('quantity', $qty) > 0;
    }

    public function decrementParentStock(int $parentId, int $qty): bool
    {
        return $this->model
            ->where('id', $parentId)
            ->where('quantity', '>=', $qty)
            ->decrement('quantity', $qty) > 0;
    }

    // hoàn kho
    public function increment(int $productId, string $field, int $qty)
    {
        return $this->model
            ->where('id', $productId)
            ->increment($field, $qty);
    }

    public function incrementParentStock(int $productId, string $field, int $qty)
    {
        $parentId = $this->model->where('id', $productId)->value('parent_id');

        if ($parentId) {
            return $this->model->where('id', $parentId)->increment($field, $qty);
        }

        return false;
    }

}
