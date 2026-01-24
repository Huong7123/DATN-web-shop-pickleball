<?php

namespace App\Services\Backend;

use App\DTO\DataResult;
use App\Interfaces\ExclusiveConfigRepositoryInterface;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class ExclusiveConfigService extends BaseService
{
    public function __construct(ExclusiveConfigRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Map dữ liệu cho bảng exclusive_configs
     */
    private function mapData(array $data, $current = null): array
    {
        return [
            'tier_name'    => $data['tier_name'] ?? ($current->tier_name ?? null),
            'min_spending' => $data['min_spending'] ?? ($current->min_spending ?? 0),
            'status'       => $data['status'] ?? ($current->status ?? 1),
        ];
    }

    public function create(array $data): DataResult
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($user->role != "2") {
            return new DataResult('Bạn không có quyền thực hiện thao tác này', 403);
        }

        DB::beginTransaction();
        try {
            // 1. Map và tạo dữ liệu cho bảng chính exclusive_configs
            $configData = $this->mapData($data);
            $item = $this->repository->create($configData);

            // 2. Xử lý lưu nhiều mã giảm giá vào bảng trung gian
            // Giả sử Repository của bạn có hàm syncDiscounts hoặc bạn sử dụng trực tiếp Model từ Repository
            if (isset($data['discount_ids']) && is_array($data['discount_ids'])) {
                // Trong Repository, bạn nên có phương thức để xử lý quan hệ sync
                $item->discounts()->sync($data['discount_ids']);
            }

            DB::commit();
            
            // Load lại quan hệ để trả về dữ liệu đầy đủ
            $item->load('discounts');
            
            return new DataResult('Cấu hình ưu đãi độc quyền thành công', 201, $item);

        } catch (\Exception $e) {
            DB::rollBack();
            return new DataResult('Có lỗi xảy ra: ' . $e->getMessage(), 500);
        }
    }
}