<?php

namespace App\Repositories;

use App\Interfaces\OfferRepositoryInterface;
use App\Models\Offer;
use App\Models\OfferDetail;

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

}
