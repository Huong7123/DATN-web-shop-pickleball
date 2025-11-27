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

    public function create(array $data): DataResult
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role != "2") {
            return new DataResult('Bạn không có quyền thực hiện thao tác này', 403);
        }

        $AttributeData = [
            'name' => $data['name'],
            'status' => '1',
        ];

        if (!empty($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $AttributeData['image'] = $data['image']->store('images', 'public');
        }

        $item = $this->repository->create($AttributeData);

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

        if (!empty($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
           
            if ($currentAttribute->image && Storage::disk('public')->exists($currentAttribute->image)) {
                Storage::disk('public')->delete($currentAttribute->image);
            }

            $data['image'] = $data['image']->store('images', 'public');
        }

        $updateData = [
            'name' => $data['name'] ?? $currentAttribute->name,
            'status' => $data['status'] ?? $currentAttribute->status,
        ];

        if (!empty($data['image'])) {
            $updateData['image'] = $data['image'];
        }

        $item = $this->repository->update($id, $updateData);

        return new DataResult('Cập nhật thành công', 200, $item);
    }

    
}