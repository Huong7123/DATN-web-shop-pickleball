<?php

namespace App\Services\Backend;

use App\DTO\DataResult;
use App\Interfaces\DiscountRepositoryInterface;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Storage;

class DiscountService extends BaseService
{
    public function __construct(DiscountRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function create(array $data): DataResult
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role != "2") {
            return new DataResult('Bạn không có quyền thực hiện thao tác này', 403);
        }

        $discountData = [
            'title' => $data['title'],
            'code' => $data['code'],
            'description' => $data['description'] ?? null,
            'percent_off' => $data['percent_off'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'status' => '1',
        ];

        if (!empty($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $discountData['image'] = $data['image']->store('images', 'public');
        }

        $item = $this->repository->create($discountData);

        return new DataResult('Thêm mới thành công', 201, $item);
    }

    public function update($id, array $data): DataResult
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role != "2") {
            return new DataResult('Bạn không có quyền thực hiện thao tác này', 403);
        }

        $currentDiscount = $this->repository->getById($id);
        if (!$currentDiscount) {
            return new DataResult("Cập nhật thất bại, id $id không tồn tại", 404);
        }

        if (!empty($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
           
            if ($currentDiscount->image && Storage::disk('public')->exists($currentDiscount->image)) {
                Storage::disk('public')->delete($currentDiscount->image);
            }

            $data['image'] = $data['image']->store('images', 'public');
        }

        $updateData = [
            'title' => $data['title'] ?? $currentDiscount->title,
            'status' => $data['status'] ?? $currentDiscount->status,
            'code' => $data['code'],
            'description' => $data['description'] ?? $currentDiscount->description ?? null,
            'percent_off' => $data['percent_off'] ?? $currentDiscount->percent_off,
            'start_date' => $data['start_date'] ?? $currentDiscount->start_date,
            'end_date' => $data['end_date'] ?? $currentDiscount->end_date,
        ];

        if (!empty($data['image'])) {
            $updateData['image'] = $data['image'];
        }

        $item = $this->repository->update($id, $updateData);

        return new DataResult('Cập nhật thành công', 200, $item);
    }

    
}