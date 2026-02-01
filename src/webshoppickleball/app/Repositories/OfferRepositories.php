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
                // Bước quan trọng: Chỉ lấy offer_details có discount thỏa mãn điều kiện
                $query->whereHas('discount', function ($q) use ($today) {
                    $q->where('end_date', '>=', $today)
                    ->where('status', 1);
                })->with('discount'); // Sau khi lọc xong mới load dữ liệu discount vào
            }])
            // Chỉ lấy Offer nếu nó có ít nhất 1 detail hợp lệ (tránh lấy Offer rỗng)
            ->whereHas('offerDetails.discount', function ($query) use ($today) {
                $query->where('end_date', '>=', $today)
                    ->where('status', 1);
            })
            ->get();
    }

}
