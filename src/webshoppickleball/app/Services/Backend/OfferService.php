<?php

namespace App\Services\Backend;

use App\DTO\DataResult;
use App\Interfaces\ExclusiveConfigRepositoryInterface;
use App\Interfaces\OfferRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class OfferService extends BaseService
{
    protected $exclusiveConfigRepo;
    protected $offerRepo;

    public function __construct(
        ExclusiveConfigRepositoryInterface $exclusiveConfigRepo,
        OfferRepositoryInterface $offerRepo
    ) {
        $this->exclusiveConfigRepo = $exclusiveConfigRepo;
        $this->offerRepo = $offerRepo;
    }

    /**
     * Quét toàn bộ hệ thống User để trao thưởng theo hạng
     */
    public function scanAndGrantRewards()
    {
        // 1. Lấy danh sách cấu hình ưu đãi
        $configs = $this->exclusiveConfigRepo->getActiveConfigsWithDiscounts();
        
        if ($configs->isEmpty()) {
            Log::info("Không có cấu hình ưu đãi nào đang hoạt động.");
            return;
        }

        // 2. Duyệt qua tất cả User có Role = 1 và Status = 1 theo từng lô (100 user mỗi lần)
        User::where('role', 1)
            ->where('status', 1)
            ->chunk(100, function ($users) use ($configs) {
                foreach ($users as $user) {
                    $this->processUserRewards($user, $configs);
                }
            });
    }

    /**
     * Xử lý kiểm tra và tạo Offer cho từng User cụ thể
     */
    private function processUserRewards(User $user, $configs)
    {
        foreach ($configs as $config) {
            // Kiểm tra điều kiện chi tiêu
            if ($user->total_spending >= $config->min_spending) {
                
                $discountIds = $config->discounts->pluck('id')->toArray();
                if (empty($discountIds)) continue;

                // Kiểm tra xem User đã nhận bộ Discount này chưa
                $alreadyReceived = $this->offerRepo->checkUserReceivedDiscounts($user->id, $discountIds);

                if (!$alreadyReceived) {
                    $this->grantOffer($user->id, $config);
                }
            }
        }
    }

    /**
     * Tạo dữ liệu Offer và OfferDetail
     */
    private function grantOffer(int $userId, $config)
    {
        DB::beginTransaction();
        try {
            // 1. Tìm Offer hiện có của User, nếu không có thì tạo mới
            $offer = $this->offerRepo->findOfferByUserId($userId);
            
            if (!$offer) {
                $offer = $this->offerRepo->createOffer($userId);
                Log::info("Đã tạo Offer mới cho User ID: {$userId}");
            }

            $details = [];
            foreach ($config->discounts as $discount) {
                // 2. Kiểm tra xem discount này đã tồn tại trong Offer của User chưa
                // Việc này giúp tránh lỗi Duplicate Entry nếu chạy lại quét nhiều lần
                $exists = \App\Models\OfferDetail::where('offer_id', $offer->id)
                            ->where('discount_id', $discount->id)
                            ->exists();

                if (!$exists) {
                    $details[] = [
                        'offer_id'    => $offer->id,
                        'discount_id' => $discount->id,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ];
                }
            }

            // 3. Chỉ insert nếu có discount mới
            if (!empty($details)) {
                $this->offerRepo->createOfferDetails($details);
                Log::info("Đã thêm " . count($details) . " ưu đãi mới vào Offer hiện có cho User ID: {$userId}");
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Lỗi khi cập nhật ưu đãi cho User {$userId}: " . $e->getMessage());
        }
    }


    public function getOfferByUserId(): DataResult
    {
        $user = JWTAuth::parseToken()->authenticate()->id;

        $data = $this->offerRepo->getOfferByUserId($user);

        return new DataResult('Lấy danh sách thành công', 200, $data);
    }
}
