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

    public function getById(int $id, array $columns = ['*'], array $with = []): DataResult
    {
        $item = $this->repository->getById($id, $columns, ['attributes', 'attributeValues']);
        if (!$item) {
            return new DataResult("Bản ghi với id $id không tồn tại", 404);
        }
        return new DataResult('Lấy dữ liệu thành công', 200, $item);
    }

    public function getParentProduct($perPage, $keyword, $status, $minPrice, $maxPrice, $categoryIds): DataResult
    {
        /** @var ProductRepositoryInterface $repo */
        $repo = $this->repository;
        $data = $repo->getParentProduct($perPage, $keyword, $status, $minPrice, $maxPrice, $categoryIds);

        return new DataResult('Lấy danh sách thành công', 200, $data);
    }

    public function getChildProduct($parentId): DataResult
    {
        /** @var ProductRepositoryInterface $repo */
        $repo = $this->repository;
        $data = $repo->getChildProduct($parentId);

        return new DataResult('Lấy danh sách thành công', 200, $data);
    }

    public function getProductBySlug($slug): DataResult
    {
        /** @var ProductRepositoryInterface $repo */
        $repo = $this->repository;
        $data = $repo->getProductBySlug($slug);
        return new DataResult('Lấy danh sách thành công', 200, $data);
    }

    public function getProductByCategory($categoryId, $productId): DataResult
    {
        /** @var ProductRepositoryInterface $repo */
        $repo = $this->repository;
        $data = $repo->getProductByCategory($categoryId, $productId);
        return new DataResult('Lấy danh sách thành công', 200, $data);
    }

    public function getVariant(int $parentId, array $selectedValueIds): DataResult
    {
        /** @var ProductRepositoryInterface $repo */
        $repo = $this->repository;
        $data = $repo->findVariant($parentId, $selectedValueIds);
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

            $images = [];
            if (!empty($data['image']) && is_array($data['image'])) {
                foreach ($data['image'] as $file) {
                    if ($file instanceof \Illuminate\Http\UploadedFile) {
                        $images[] = $file->store('images', 'public');
                    }
                }
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
                'level' => $data['level'],
                'play_style' => $data['play_style'],
                'parent_id' => 0,
                'image'     => json_encode($images),
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

            // 5. Tạo variant + gắn attribute_value cho từng biến thể
            $totalQty = 0;

            foreach ($combinations as $i => $combo) {

                $names = [];
                foreach ($combo as $valId) {
                    $names[] = $valueMap[$valId]->name;
                }

                $variantName = $data['name'].' - '.implode(' - ', $names);

                $variant = $repo->create([
                    'name'      => $variantName,
                    'slug'      => Str::slug($variantName).'-'.Str::random(4),
                    'price'     => $data['price'][$i] ?? $data['price_main'],
                    'quantity'  => $data['quantity'][$i] ?? 0,
                    'status'    => 1,
                    'parent_id' => $mainProduct->id,
                    'image'     => $mainProduct->image,
                    'level' => $data['level'],
                    'play_style' => $data['play_style'],
                    'category_id' => $data['category_id'] ?? null,
                ]);

                // 👇 GẮN ATTRIBUTE_VALUE CHO VARIANT
                $repo->attachAttributeValues($variant->id, $combo);

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

            // =========================
            // UPDATE BIẾN THỂ RIÊNG LẺ
            // =========================
            if ($product->parent_id != 0) {
                $repo->update($id, [
                    'price'    => $data['price'] ?? $product->price,
                    'quantity' => $data['quantity'] ?? $product->quantity,
                ]);

                $repo->update($product->parent_id, [
                    'quantity' => $repo->sumVariantQuantity($product->parent_id)
                ]);

                return new DataResult('Cập nhật biến thể thành công', 200);
            }

            // =========================
            // UPDATE SẢN PHẨM CHA
            // =========================
            $productData = [
                'name'        => $data['name'] ?? $product->name,
                'status'      => $data['status'] ?? $product->status,
                'slug'        => Str::slug($data['name'] ?? $product->name),
                'description' => $data['description'] ?? $product->description,
                'category_id' => $data['category_id'] ?? $product->category_id,
                'price'       => $data['price_main'] ?? $product->price,
            ];

            // Update image
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

            // =========================
            // REBUILD BIẾN THỂ
            // =========================
            if (!empty($data['attribute_ids']) && !empty($data['attribute_value_ids'])) {

                /** 1️⃣ LẤY BIẾN THỂ CŨ + MAP DATA */
                $variants = $repo->getVariant($id);

                $oldVariantMap = [];

                foreach ($variants as $variant) {
                    $key = $variant->attributeValues
                        ->pluck('id')
                        ->sort()
                        ->implode('-');

                    $oldVariantMap[$key] = [
                        'quantity'   => $variant->quantity,
                        'sold'       => $variant->sold ?? 0,
                        'level'      => $variant->level ?? null,
                        'play_style' => $variant->play_style ?? null,
                    ];
                }

                /** 2️⃣ DISABLE BIẾN THỂ CŨ */
                foreach ($variants as $variant) {
                    $repo->update($variant->id, [
                        'status'   => 0,
                        'quantity' => 0,
                    ]);
                }

                /** 3️⃣ GÁN ATTRIBUTE CHO CHA */
                $repo->attachAttributes($id, $data['attribute_ids']);

                $groups = $data['attribute_value_ids'];
                $allValueIds = collect($groups)->flatten()->unique()->toArray();
                $repo->attachAttributeValues($id, $allValueIds);

                /** 4️⃣ MAP ATTRIBUTE VALUE */
                $valueMap = \App\Models\AttributeValue::whereIn('id', $allValueIds)
                    ->get()
                    ->keyBy('id');

                /** 5️⃣ SINH TỔ HỢP */
                $combinations = [[]];
                foreach ($groups as $group) {
                    $tmp = [];
                    foreach ($combinations as $partial) {
                        foreach ($group as $valId) {
                            $tmp[] = array_merge($partial, [$valId]);
                        }
                    }
                    $combinations = $tmp;
                }

                /** 6️⃣ TẠO BIẾN THỂ MỚI + RESTORE DATA */
                $totalQty = 0;

                foreach ($combinations as $i => $combo) {

                    $names = [];
                    foreach ($combo as $valId) {
                        $names[] = $valueMap[$valId]->name;
                    }

                    $variantName = $productData['name'] . ' - ' . implode(' - ', $names);

                    $key = collect($combo)->sort()->implode('-');

                    $old = $oldVariantMap[$key] ?? [
                        'quantity'   => 0,
                        'sold'       => 0,
                        'level'      => null,
                        'play_style' => null,
                    ];

                    $variant = $repo->create([
                        'image'       => $product->image,
                        'name'        => $variantName,
                        'slug'        => Str::slug($variantName) . '-' . Str::random(4),
                        'price'       => $data['price'][$i] ?? $productData['price'],
                        'quantity'    => $old['quantity'],
                        'sold'        => $old['sold'],
                        'level'       => $old['level'],
                        'play_style'  => $old['play_style'],
                        'status'      => 1,
                        'parent_id'   => $id,
                        'description' => null,
                        'category_id' => $productData['category_id'],
                    ]);

                    $repo->attachAttributeValues($variant->id, $combo);

                    $totalQty += $old['quantity'];
                }

                /** 7️⃣ UPDATE QUANTITY CHA */
                $repo->update($id, ['quantity' => $totalQty]);
            }

            return new DataResult('Cập nhật sản phẩm cha thành công', 200);

        } catch (\Exception $e) {
            return new DataResult('Lỗi cập nhật: ' . $e->getMessage(), 500);
        }
    }

}