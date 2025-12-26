<?php

namespace App\Interfaces;


interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    // CRUD chung đã có trong BaseRepository, nên không cần khai báo lại

    public function createVariant(array $variantData);

    /**
     * Gán attributes cho sản phẩm
     */
    public function attachAttributes($productId, array $attributeIds);

    /**
     * Gán attribute values cho sản phẩm
     */
    public function attachAttributeValues($productId, array $valueIds);

    /**
     * Gán attribute values cho biến thể
     */
    public function attachVariantValues(int $variantId, array $valueIds);

    /**
     * Xóa biến thể
     */
    public function deleteVariant(int $variantId): bool;

    /**
     * Hủy gán attributes của sản phẩm
     */
    public function detachAttributes(int $productId): bool;

    /**
     * Hủy gán attribute values của sản phẩm
     */
    public function detachAttributeValues(int $productId): bool;

    public function getParentProduct($perPage, $keyword, $status);
    public function getChildProduct($parentId);
    public function getProductBySlug($slug);
    public function getProductByCategory($categoryId, $productId);
    public function sumVariantQuantity(int $parentId): int;

    
}
