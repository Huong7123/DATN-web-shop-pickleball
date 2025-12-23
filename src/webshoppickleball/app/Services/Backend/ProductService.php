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
        ];

        $data = $this->repository->paginateWithFilters($filters, $perPage, ['*'], $relations);

        return new DataResult('Lấy danh sách thành công', 200, $data);
    }

    public function getParentProduct($perPage): DataResult
    {
        /** @var ProductRepositoryInterface $repo */
        $repo = $this->repository;
        $data = $repo->getParentProduct($perPage);

        return new DataResult('Lấy danh sách thành công', 200, $data);
    }

    public function getChildProduct($parentId): DataResult
    {
        /** @var ProductRepositoryInterface $repo */
        $repo = $this->repository;
        $data = $repo->getChildProduct($parentId);

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

            // sinh tổ hợp biến thể
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

            // tạo sản phẩm gốc
            $mainProductData = [
                'name'        => $data['name'],
                'slug'        => Str::slug($data['name']),
                'description' => $data['description'] ?? null,
                'category_id' => $data['category_id'] ?? null,
                'price'       => $data['price_main'] ?? 0,
                'quantity'    => 0,
                'status'      => 1,
                'parent_id'   => 0
            ];

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
                return new DataResult("Tạo sản phẩm gốc thất bại", 500);
            }

            $createdMainProducts[] = $mainProduct->id;

            //tạo biến thể
            $totalVariantQuantity = 0;
            foreach ($combinations as $index => $combo) {
                $variantQuantity = $data['quantity'][$index] ?? 0;
                $totalVariantQuantity += $variantQuantity;
                $variantData = [
                    'name'        => $data['name'] . ' - ' . implode(", ", $combo),
                    'slug'        => Str::slug($data['name'] . '-' . implode('-', $combo)),
                    'description' => null,
                    'category_id' => $data['category_id'] ?? null,
                    'price'       => $data['price'][$index] ?? $data['price_main'] ?? 0,
                    'quantity'    => $data['quantity'][$index] ?? 0,
                    'status'      => 1,
                    'parent_id'   => $mainProduct->id
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
            }

            $repo->update($mainProduct->id, [
                'quantity' => $totalVariantQuantity
            ]);

            return new DataResult("Tạo sản phẩm gốc + biến thể thành công", 201, [
                "product_id" => $mainProduct->id,
                "variants"   => $createdVariants
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if ($user->role != "2") {
                return new DataResult('Bạn không có quyền thực hiện thao tác này', 403);
            }

            /** @var ProductRepositoryInterface $repo */
            $repo = $this->repository;

            $product = $repo->getById($id);
            if (!$product) {
                return new DataResult('Sản phẩm không tồn tại', 404);
            }

            //update giá, số lượng của sản phẩm biến thể
            if ($product->parent_id != 0) {

                $repo->update($id, [
                    'price'    => $data['price'] ?? $product->price,
                    'quantity' => $data['quantity'] ?? $product->quantity,
                ]);

                // 🔁 Cập nhật lại quantity sản phẩm cha
                $parentId = $product->parent_id;
                $repo->update($parentId, [
                    'quantity' => $repo->sumVariantQuantity($parentId)
                ]);

                return new DataResult('Cập nhật biến thể thành công', 200);
            }

            //update sản phẩm cha
            $productData = [
                'name'        => $data['name'] ?? $product->name,
                'slug'        => Str::slug($data['name'] ?? $product->name),
                'description' => $data['description'] ?? $product->description,
                'category_id' => $data['category_id'] ?? $product->category_id,
                'price'       => $data['price'] ?? $product->price,
            ];

            // 🖼️ Update ảnh
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

            $repo->update($id, $productData);

            // xoá biến thể cũ và tạo lại nếu có thay đổi về thuộc tính
            if (!empty($data['attribute_ids']) && !empty($data['attribute_value_ids'])) {

                $variants = $repo->getChildProduct($id);

                foreach ($variants as $variant) {
                    $repo->detachAttributes($variant->id);
                    $repo->detachAttributeValues($variant->id);
                    $repo->delete($variant->id);
                }

                // Gán attributes mới cho sản phẩm cha
                $repo->attachAttributes($id, $data['attribute_ids']);

                // 🔁 Sinh lại biến thể
                $groups = $data['attribute_value_ids'];
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

                foreach ($combinations as $combo) {
                    $variant = $repo->create([
                        'name'        => $productData['name'] . ' - ' . implode(', ', $combo),
                        'slug'        => Str::slug($productData['name'] . '-' . implode('-', $combo)),
                        'description' => null,
                        'category_id' => $productData['category_id'],
                        'price'       => $productData['price'],
                        'quantity'    => 0,
                        'status'      => 1,
                        'parent_id'   => $id,
                    ]);

                    $repo->attachAttributeValues($variant->id, $combo);
                }

                // Update quantity cha
                $repo->update($id, [
                    'quantity' => $repo->sumVariantQuantity($id)
                ]);
            }

            return new DataResult('Cập nhật sản phẩm cha thành công', 200);

        } catch (\Exception $e) {
            return new DataResult('Lỗi cập nhật: ' . $e->getMessage(), 500);
        }
    }

}