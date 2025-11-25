<?php

namespace App\Services\Backend;

use App\DTO\DataResult;
use App\Interfaces\CategoryRepositoryInterface;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;

class CategoryService extends BaseService
{
    public function __construct(CategoryRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function create(array $data): DataResult
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role != "2") {
            return new DataResult('Bạn không có quyền thực hiện thao tác này', 403);
        }

        $categoryData = [
            'name' => $data['name'],
            'status' => '1',
        ];

        if (!empty($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $categoryData['image'] = $data['image']->store('images', 'public');
        }

        $item = $this->repository->create($categoryData);

        return new DataResult('Thêm mới thành công', 201, $item);
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
            'name' => $data['name'],
            'status' => $data['status'],
        ];

        if (!empty($data['image'])) {
            $updateData['image'] = $data['image'];
        }

        $item = $this->repository->update($id, $updateData);

        return new DataResult('Cập nhật thành công', 200, $item);
    }

    
}