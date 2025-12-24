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

    public function getById(int $id, array $columns = ['*']): DataResult
    {
        $item = $this->repository->getById($id, $columns, ['attributes', 'attributeValues']);
        if (!$item) {
            return new DataResult("Bản ghi với id $id không tồn tại", 404);
        }
        return new DataResult('Lấy dữ liệu thành công', 200, $item);
    }

    public function getParentProduct($perPage, $keyword, $status): DataResult
    {
        /** @var ProductRepositoryInterface $repo */
        $repo = $this->repository;
        $data = $repo->getParentProduct($perPage, $keyword, $status);

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
            if (empty($groups)) {
                return new DataResult('Thiếu giá trị thuộc tính', 422);
            }

            // 1. Tạo product gốc
            $mainProduct = $repo->create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'description' => $data['description'] ?? null,
                'category_id' => $data['category_id'] ?? null,
                'price' => $data['price_main'] ?? 0,
                'quantity' => 0,
                'status' => 1,
                'parent_id' => 0,
            ]);

            $createdMainProducts[] = $mainProduct->id;

            // 2. GÁN ATTRIBUTE + VALUE CHO PRODUCT GỐC
            $repo->attachAttributes($mainProduct->id, $data['attribute_ids']);

            $allValueIds = collect($groups)->flatten()->unique()->toArray();
            $repo->attachAttributeValues($mainProduct->id, $allValueIds);

            // 3. Sinh tổ hợp biến thể
            $combinations = [[]];
            foreach ($groups as $g) {
                $tmp = [];
                foreach ($combinations as $partial) {
                    foreach ($g as $val) {
                        $tmp[] = array_merge($partial, [$val]);
                    }
                }
                $combinations = $tmp;
            }

            // 4. Map tên attribute_value
            $valueMap = \App\Models\AttributeValue::with('attribute')
                ->whereIn('id', $allValueIds)
                ->get()
                ->keyBy('id');

            // 5. Tạo variant (chỉ giữ kho & giá)
            $totalQty = 0;
            foreach ($combinations as $i => $combo) {

                $names = [];
                foreach ($combo as $valId) {
                    $names[] = $valueMap[$valId]->name;
                }

                $variantName = $data['name'].' - '.implode(' - ', $names);

                $variant = $repo->create([
                    'name' => $variantName,
                    'slug' => Str::slug($variantName).'-'.Str::random(4),
                    'price' => $data['price'][$i] ?? $data['price_main'],
                    'quantity' => $data['quantity'][$i] ?? 0,
                    'status' => 1,
                    'parent_id' => $mainProduct->id,
                ]);

                $createdVariants[] = $variant->id;
                $totalQty += $variant->quantity;
            }

            $repo->update($mainProduct->id, ['quantity' => $totalQty]);

            return new DataResult("Tạo sản phẩm + biến thể thành công", 201, [
                'product_id' => $mainProduct->id,
                'variants' => $createdVariants
            ]);

        } catch (\Exception $e) {
            $this->rollback($repo, $createdVariants, $createdMainProducts);
            return new DataResult("Lỗi: ".$e->getMessage(), 500);
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