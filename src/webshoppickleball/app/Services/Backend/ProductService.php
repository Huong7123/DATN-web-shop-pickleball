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
        $data = $this->repository->paginateWithFilters($filters, $perPage, ['*'], ['attributes.attributeValues','category']);

        return new DataResult('Lấy danh sách thành công', 200, $data);
    }

    public function create(array $data): DataResult
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role != "2") {
            return new DataResult('Bạn không có quyền thực hiện thao tác này', 403);
        }

        $productData = [
            'name'        => $data['name'],
            'slug'        => Str::slug($data['name']),
            'description' => $data['description'] ?? null,
            'category_id' => $data['category_id'] ?? null,
            'price'       => $data['price'] ?? 0,
            'quantity'    => $data['quantity'] ?? 0,
            'status'      => 1,
        ];
        
        $paths = [];
        if (!empty($data['image'])) {
            $images = is_array($data['image']) ? $data['image'] : [$data['image']];
            foreach ($images as $img) {
                if ($img instanceof UploadedFile) {
                    $paths[] = $img->store('images', 'public');
                }
            }
        }

        if (!empty($paths)) {
            $productData['image'] = json_encode($paths);
        }

        $product = $this->repository->create($productData);

        if (!empty($data['attribute_ids']) && is_array($data['attribute_ids'])) {
            $product->attributes()->sync($data['attribute_ids']);
        }

        if (!empty($data['attribute_values']) && is_array($data['attribute_values'])) {

            $valueIds = [];

            foreach ($data['attribute_values'] as $attributeId => $values) {
                foreach ($values as $valueId) {
                    $valueIds[] = $valueId;
                }
            }

            $product->attributeValues()->sync($valueIds);
        }

        return new DataResult('Thêm mới thành công', 201, $product);
    }

    public function update($id, array $data): DataResult
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role != "2") {
            return new DataResult('Bạn không có quyền thực hiện thao tác này', 403);
        }

        $currentCategory = $this->repository->getById($id);
        if (!$currentCategory) {
            return new DataResult("Cập nhật thất bại, id $id không tồn tại", 404);
        }

        if (!empty($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
           
            if ($currentCategory->image && Storage::disk('public')->exists($currentCategory->image)) {
                Storage::disk('public')->delete($currentCategory->image);
            }

            $data['image'] = $data['image']->store('images', 'public');
        }

        $updateData = [
            'name' => $data['name'] ?? $currentCategory->name,
            'status' => $data['status'] ?? $currentCategory->status,
        ];

        if (!empty($data['image'])) {
            $updateData['image'] = $data['image'];
        }

        $item = $this->repository->update($id, $updateData);

        return new DataResult('Cập nhật thành công', 200, $item);
    }

    
}