<?php

namespace App\Services\Backend;

use App\DTO\DataResult;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\UploadedFile;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService extends BaseService
{
    public function __construct(ProductRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function paginateWithFilters(array $filters, int $perPage = 10): DataResult
    {
        $relations = [
            'category',
            'attributes.attributeValues',
            'variants.values.attribute',
        ];

        $data = $this->repository->paginateWithFilters($filters, $perPage, ['*'], $relations);

        return new DataResult('Lấy danh sách thành công', 200, $data);
    }

    public function create(array $data): DataResult
    {
        $createdVariants = [];
        $createdMainProducts = [];

        try {
            $user = JWTAuth::parseToken()->authenticate();
            if ($user->role != "2") {
                return new DataResult('Bạn không có quyền thực hiện thao tác này', 403);
            }

            /** @var ProductRepositoryInterface $repo */
            $repo = $this->repository;

            $groups = $data['attribute_value_ids'] ?? [];
            if (!is_array($groups) || empty($groups)) {
                return new DataResult('Thiếu giá trị thuộc tính', 422);
            }

            foreach ($groups as $i => $g) {
                if (!is_array($g)) {
                    return new DataResult("attribute_value_ids[$i] phải là mảng con", 422);
                }
            }

            //sinh tổ hợp biến thể
            $combinations = [[]];
            foreach ($groups as $g) {
                $tmp = [];
                foreach ($combinations as $partial) {
                    foreach ($g as $valId) {
                        $tmp[] = array_merge($partial, [$valId]);
                    }
                }
                $combinations = $tmp;
            }

            if (empty($combinations)) {
                return new DataResult("Không tạo được tổ hợp biến thể", 422);
            }

            //tạo sản phẩm gốc + biến thể
            foreach ($combinations as $index => $combo) {

                //tạo sản phẩm gốc
                $variantData = [
                    'name'        => $data['name'] . ' - ' . implode(", ", $combo),
                    'slug'        => Str::slug($data['name'] . '-' . implode("-", $combo)),
                    'description' => null,
                    'category_id' => $data['category_id'] ?? null,
                    'status'      => 1,
                    'parent_id'   => 0
                ];

                $variant = $repo->create($variantData);
                if (!$variant) {
                    $this->rollback($repo, $createdVariants, $createdMainProducts);
                    return new DataResult("Tạo biến thể thất bại", 500);
                }

                $createdVariants[] = $variant->id;

                // Gán attributes
                if (!empty($data['attribute_ids'])) {
                    if (!$repo->attachAttributes($variant->id, $data['attribute_ids'])) {
                        $this->rollback($repo, $createdVariants, $createdMainProducts);
                        return new DataResult("Lỗi gán attributes", 500);
                    }
                }

                // Gán attribute values
                if (!$repo->attachAttributeValues($variant->id, $combo)) {
                    $this->rollback($repo, $createdVariants, $createdMainProducts);
                    return new DataResult("Lỗi gán attribute values", 500);
                }
                //tạo biến thể
                $mainProductData = [
                    'name'        => $data['name'],
                    'slug'        => Str::slug($data['name']) . '-' . $variant->id,
                    'description' => $data['description'] ?? null,
                    'category_id' => $data['category_id'] ?? null,
                    'price'       => $data['price'][$index] ?? 0,
                    'quantity'    => $data['quantity'][$index] ?? 0,
                    'status'      => 1,
                    'parent_id'   => $variant->id,
                ];

                // Upload ảnh
                if (!empty($data['image'])) {
                    $paths = [];
                    foreach ((array)$data['image'] as $img) {
                        if ($img instanceof UploadedFile) {
                            $paths[] = $img->store('images', 'public');
                        }
                    }
                    $mainProductData['image'] = json_encode($paths);
                }

                $mainProduct = $repo->create($mainProductData);

                if (!$mainProduct) {
                    $this->rollback($repo, $createdVariants, $createdMainProducts);
                    return new DataResult("Tạo sản phẩm chính thất bại", 500);
                }

                $createdMainProducts[] = $mainProduct->id;
            }

            return new DataResult("Tạo toàn bộ biến thể + sản phẩm chính thành công", 201, [
                "variants" => $createdVariants,
                "products" => $createdMainProducts
            ]);

        } catch (\Exception $e) {
            $this->rollback($repo, $createdVariants, $createdMainProducts);
            return new DataResult("Lỗi: " . $e->getMessage(), 500);
        }
    }

    private function rollback($repo, $variantIds, $productIds)
    {
        foreach ($productIds as $id) {
            $repo->delete($id);
        }

        foreach ($variantIds as $id) {
            $repo->detachAttributes($id);
            $repo->detachAttributeValues($id);
            $repo->delete($id);
        }
    }

    public function update(int $id, array $data): DataResult
    {
        $product = null;

        try {
            $user = JWTAuth::parseToken()->authenticate();
            if ($user->role != "2") {
                return new DataResult('Bạn không có quyền thực hiện thao tác này', 403);
            }

            /** @var ProductRepositoryInterface $repo */
            $repo = $this->repository;

            // Tìm sản phẩm
            $product = $repo->getById($id);
            if (!$product) {
                return new DataResult('Sản phẩm không tồn tại', 404);
            }

            // 1. Chuẩn bị dữ liệu update
            $productData = [
                'name'        => $data['name'] ?? $product->name,
                'slug'        => Str::slug($data['name'] ?? $product->name),
                'description' => $data['description'] ?? $product->description,
                'category_id' => $data['category_id'] ?? $product->category_id,
                'price'       => $data['price'] ?? $product->price,
                'quantity'    => $data['quantity'] ?? $product->quantity,
                'status'      => $data['status'] ?? $product->status,
            ];

            // Upload ảnh mới nếu có
            if (!empty($data['image'])) {
                $images = is_array($data['image']) ? $data['image'] : [$data['image']];
                $paths = [];
                foreach ($images as $img) {
                    if ($img instanceof UploadedFile) {
                        $paths[] = $img->store('images', 'public');
                    }
                }

                if (!empty($paths)) {
                    $productData['image'] = json_encode($paths);
                }
            }

            // Update sản phẩm
            $updatedProduct = $repo->update($id, $productData);
            if (!$updatedProduct) {
                return new DataResult('Cập nhật sản phẩm thất bại', 500);
            }

            // 2. Update attributes
            if (!empty($data['attribute_ids']) && is_array($data['attribute_ids'])) {
                if (!$repo->attachAttributes($id, $data['attribute_ids'])) {
                    return new DataResult('Cập nhật attributes thất bại', 500);
                }
            }

            // 3. Update attribute values
            if (!empty($data['attribute_value_ids']) && is_array($data['attribute_value_ids'])) {
                if (!$repo->attachAttributeValues($id, $data['attribute_value_ids'])) {
                    return new DataResult('Cập nhật attribute values thất bại', 500);
                }
            }

            // 4. Xóa tất cả variants cũ
            foreach ($product->variants as $variant) {
                $repo->deleteVariant($variant->id);
            }

            // Tạo lại biến thể từ payload mới
            if (!empty($data['variants']) && is_array($data['variants'])) {
                foreach ($data['variants'] as $variantData) {

                    // Tạo variant mới
                    $variant = $repo->createVariant([
                        'product_id' => $product->id,
                        'sku'        => $variantData['sku'] ?? Str::uuid(),
                        'price'      => $variantData['price'] ?? 0,
                        'quantity'   => $variantData['quantity'] ?? 0,
                        'status'     => $variantData['status'] ?? 1,
                    ]);

                    if (!$variant) {
                        return new DataResult('Cập nhật variant thất bại', 500);
                    }

                    // Gán value cho variant
                    if (!empty($variantData['value_ids']) && is_array($variantData['value_ids'])) {
                        if (!$repo->attachVariantValues($variant->id, $variantData['value_ids'])) {
                            $repo->deleteVariant($variant->id);
                            return new DataResult('Gán giá trị cho variant thất bại', 500);
                        }
                    }
                }
            }

            return new DataResult('Cập nhật sản phẩm thành công', 200, $updatedProduct);

        } catch (\Exception $e) {

            return new DataResult('Lỗi cập nhật: ' . $e->getMessage(), 500);
        }
    }


}