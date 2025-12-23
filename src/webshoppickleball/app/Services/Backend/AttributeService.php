<?php

namespace App\Services\Backend;

use App\DTO\DataResult;
use App\Interfaces\AttributeRepositoryInterface;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;

class AttributeService extends BaseService
{
    public function __construct(AttributeRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function paginateWithFilters(array $filters, int $perPage = 10): DataResult
    {
        $relations = [
            'attributeValues',
        ];

        $data = $this->repository->paginateWithFilters($filters, $perPage, ['*'], $relations);

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
            'status' => $data['status'] ?? $currentAttribute->status,
        ];

        $item = $this->repository->update($id, $updateData);

        return new DataResult('Cập nhật thành công', 200, $item);
    }

    
}