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

    public function getParentProduct($perPage, $keyword, $status, $minPrice, $maxPrice, $categoryIds);
    public function getChildProduct($parentId);
    public function getProductBySlug($slug);
    public function getProductByCategory($categoryId, $productId);
    function findVariant(int $parentId, array $selectedValueIds);
    public function sumVariantQuantity(int $parentId): int;
    public function decrementStock(int $productId, int $qty): bool;
    public function decrementParentStock(int $parentId, int $qty): bool;
    public function increment(int $productId, string $field, int $qty);
    public function incrementParentStock(int $productId, string $field, int $qty);
    public function incrementSold(int $productId, int $qty): bool;
    public function decrementSoldChildProduct(int $productId, int $qty): bool;
    public function decrementSoldParentProduct(int $productId, int $qty): bool;
    public function getActiveProductsForConsulting();
}
