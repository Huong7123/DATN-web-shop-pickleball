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
        $product = null;

        try {
            $user = JWTAuth::parseToken()->authenticate();
            if ($user->role != "2") {
                return new DataResult('Bạn không có quyền thực hiện thao tác này', 403);
            }

            /** @var ProductRepositoryInterface $repo */
            $repo = $this->repository;

            // 1. Tạo sản phẩm
            $productData = [
                'name'        => $data['name'],
                'slug'        => Str::slug($data['name']),
                'description' => $data['description'] ?? null,
                'category_id' => $data['category_id'] ?? null,
                'price'       => $data['price'] ?? 0,
                'quantity'    => $data['quantity'] ?? 0,
                'status'      => 1,
            ];

            // Upload ảnh
            if (!empty($data['image'])) {
                $images = is_array($data['image']) ? $data['image'] : [$data['image']];
                $paths = [];
                foreach ($images as $img) {
                    if ($img instanceof UploadedFile) {
                        $paths[] = $img->store('images', 'public');
                    }
                }
                $productData['image'] = !empty($paths) ? json_encode($paths) : null;
            }

            $product = $repo->create($productData);
            if (!$product) {
                return new DataResult('Tạo sản phẩm thất bại', 500);
            }

            // 2. Gán attributes
            if (!empty($data['attribute_ids']) && is_array($data['attribute_ids'])) {
                if (!$repo->attachAttributes($product->id, $data['attribute_ids'])) {
                    $repo->delete($product->id);
                    return new DataResult('Gán attributes thất bại', 500);
                }
            }

            // 3. Gán attribute values cho sản phẩm
            if (!empty($data['attribute_value_ids']) && is_array($data['attribute_value_ids'])) {
                if (!$repo->attachAttributeValues($product->id, $data['attribute_value_ids'])) {
                    $repo->detachAttributes($product->id);
                    $repo->delete($product->id);
                    return new DataResult('Gán attribute values thất bại', 500);
                }
            }

            // 4. Tạo biến thể
            if (!empty($data['variants']) && is_array($data['variants'])) {
                foreach ($data['variants'] as $variantData) {
                    $variant = $repo->createVariant([
                        'product_id' => $product->id,
                        'sku'        => $variantData['sku'] ?? Str::uuid(),
                        'price'      => $variantData['price'] ?? 0,
                        'quantity'   => $variantData['quantity'] ?? 0,
                        'status'     => $variantData['status'] ?? 1,
                    ]);

                    if (!$variant) {
                        $repo->detachAttributeValues($product->id);
                        $repo->detachAttributes($product->id);
                        $repo->delete($product->id);
                        return new DataResult('Tạo variant thất bại', 500);
                    }

                    // Gán attribute values cho biến thể
                    if (!empty($variantData['value_ids']) && is_array($variantData['value_ids'])) {
                        if (!$repo->attachVariantValues($variant->id, $variantData['value_ids'])) {
                            $repo->deleteVariant($variant->id);
                            $repo->detachAttributeValues($product->id);
                            $repo->detachAttributes($product->id);
                            $repo->delete($product->id);
                            return new DataResult('Gán variant value thất bại', 500);
                        }
                    }
                }
            }

            return new DataResult('Thêm mới sản phẩm thành công', 201, $product);

        } catch (\Exception $e) {
            // Rollback thủ công nếu có lỗi bất ngờ
            if (!empty($product->id ?? null)) {
                $repo->detachAttributeValues($product->id);
                $repo->detachAttributes($product->id);
                foreach ($product->variants as $variant) {
                    $repo->deleteVariant($variant->id);
                }
                $repo->delete($product->id);
            }

            return new DataResult('Thêm sản phẩm thất bại: ' . $e->getMessage(), 500);
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