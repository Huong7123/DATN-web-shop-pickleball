<?php

namespace App\Repositories;

use App\Interfaces\OfferRepositoryInterface;
use App\Models\Offer;
use App\Models\OfferDetail;
use Carbon\Carbon;

class OfferRepositories  extends BaseRepositories implements OfferRepositoryInterface
{
    public function __construct(Offer $model)
    {
        parent::__construct($model);
    }

    public function checkUserReceivedDiscounts(int $userId, array $discountIds): bool
    {
        return OfferDetail::whereHas('offer', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->whereIn('discount_id', $discountIds)
            ->exists();
    }

    public function createOffer(int $userId): Offer
    {
        return Offer::create(['user_id' => $userId]);
    }

    public function createOfferDetails(array $details): void
    {
        OfferDetail::insert($details);
    }

    public function findOfferByUserId(int $userId)
    {
        return Offer::where('user_id', $userId)->first();
    }

    public function getOfferByUserId(int $userId)
    {
        $today = \Carbon\Carbon::today()->toDateString();

        return Offer::where('user_id', $userId)
            ->with(['offerDetails' => function ($query) use ($today) {
                // 1. Chỉ lấy các chi tiết ưu đãi CHƯA SỬ DỤNG (used = 0)
                $query->where('used', 0)
                    ->whereHas('discount', function ($q) use ($today) {
                        // 2. Và các mã giảm giá đó phải còn hạn + đang hoạt động
                        $q->where('end_date', '>=', $today)
                        ->where('status', 1);
                    })
                    ->with('discount'); 
            }])
            // Chỉ lấy Offer cha nếu nó có ít nhất 1 detail thỏa mãn cả 2 điều kiện trên
            ->whereHas('offerDetails', function ($query) use ($today) {
                $query->where('used', 0)
                    ->whereHas('discount', function ($q) use ($today) {
                        $q->where('end_date', '>=', $today)
                        ->where('status', 1);
                    });
            })
            ->get();
    }

    public function updateStatusUsed(int $userId, int $discountId)
    {
        // Tìm OfferDetail có discount_id này 
        // VÀ phải thuộc về Offer của đúng User này
        return OfferDetail::where('discount_id', $discountId)
            ->whereHas('offer', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->update(['used' => 1]);
    }


}
