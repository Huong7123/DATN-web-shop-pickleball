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

    public function getParentProduct($perPage)
    {
        return $this->model
            ->with([
                'category',
                'attributes',
                'attributeValues',
            ])
            ->where('parent_id', 0)
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

    public function sumVariantQuantity(int $parentId): int
    {
        return $this->model
            ->where('parent_id', $parentId)
            ->sum('quantity');
    }

}
