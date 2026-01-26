<?php

namespace App\Services\Backend;

use App\DTO\DataResult;
use App\Interfaces\DiscountRepositoryInterface;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class DiscountService extends BaseService
{
    public function __construct(DiscountRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Chuẩn bị dữ liệu từ request để lưu vào DB
     */
    private function mapDiscountData(array $data, $current = null): array
    {
        return [
            'title'               => $data['title'] ?? $current->title,
            'code'                => $data['code'] ?? $current->code,
            'description'         => $data['description'] ?? ($current->description ?? null),
            'discount_type'       => $data['discount_type'] ?? $current->discount_type,
            'discount_value'      => $data['discount_value'] ?? $current->discount_value,
            'max_discount_amount' => $data['max_discount_amount'] ?? ($current->max_discount_amount ?? null),
            'min_order_value'     => $data['min_order_value'] ?? ($current->min_order_value ?? 0),
            'min_total_spent'     => $data['min_total_spent'] ?? ($current->min_total_spent ?? 0),
            'is_first_order'      => isset($data['is_first_order']) ? (bool)$data['is_first_order'] : ($current->is_first_order ?? false),
            'start_date'          => $data['start_date'] ?? $current->start_date,
            'end_date'            => $data['end_date'] ?? $current->end_date,
            'usage_limit'         => $data['usage_limit'] ?? ($current->usage_limit ?? null),
            'status'              => $data['status'] ?? ($current->status ?? 1),
        ];
    }

    public function create(array $data): DataResult
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->role != "2") {
            return new DataResult('Bạn không có quyền thực hiện thao tác này', 403);
        }

        $discountData = $this->mapDiscountData($data);
        $item = $this->repository->create($discountData);

        return new DataResult('Thêm mới mã giảm giá thành công', 201, $item);
    }

    public function update($id, array $data): DataResult
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->role != "2") {
            return new DataResult('Bạn không có quyền thực hiện thao tác này', 403);
        }

        $currentDiscount = $this->repository->getById($id);
        if (!$currentDiscount) {
            return new DataResult("Mã giảm giá (ID: $id) không tồn tại", 404);
        }

        $updateData = $this->mapDiscountData($data, $currentDiscount);
        $item = $this->repository->update($id, $updateData);

        return new DataResult('Cập nhật mã giảm giá thành công', 200, $item);
    }
}