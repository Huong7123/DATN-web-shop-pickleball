<?php

namespace App\Services\Backend;

use App\DTO\DataResult;
use App\Interfaces\AttributeValueRepositoryInterface;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;

class AttributeValueService extends BaseService
{
    public function __construct(AttributeValueRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function paginateWithFilters(array $filters, int $perPage = 10): DataResult
    {
        $data = $this->repository->paginateWithFilters($filters, $perPage, ['*'], ['attribute']);

        return new DataResult('Lấy danh sách thành công', 200, $data);
    }

    public function create(array $data): DataResult
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role != "2") {
            return new DataResult('Bạn không có quyền thực hiện thao tác này', 403);
        }

        $attributeData = [
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'attribute_id' => $data['attribute_id'] ?? 0,
            'status' => '1',
        ];

        $item = $this->repository->create($attributeData);

        return new DataResult('Thêm mới thành công', 201, $item);
    }

    public function update($id, array $data): DataResult
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role != "2") {
            return new DataResult('Bạn không có quyền thực hiện thao tác này', 403);
        }

        $currentAttribute = $this->repository->getById($id);
        if (!$currentAttribute) {
            return new DataResult("Cập nhật thất bại, id $id không tồn tại", 404);
        }

        $updateData = [
            'name' => $data['name'] ?? $currentAttribute->name,
            'description' => $data['description'] ?? $currentAttribute->description,
            'attribute_id' => $data['attribute_id'] ?? $currentAttribute->attribute_id,
            'status' => $data['status'] ?? $currentAttribute->status,
        ];

        $item = $this->repository->update($id, $updateData);

        return new DataResult('Cập nhật thành công', 200, $item);
    }

    
}