<?php

namespace App\Interfaces;

use App\Models\Discount;
use App\Models\Offer;

interface OfferRepositoryInterface extends BaseRepositoryInterface
{
    // CRUD chung đã có trong BaseRepository, nên không cần khai báo lại

    // Các phương thức đặc thù của Category
    public function checkUserReceivedDiscounts(int $userId, array $discountIds): bool;
    public function createOffer(int $userId): Offer;
    public function createOfferDetails(array $details): void;
    public function findOfferByUserId(int $userId);
    public function getOfferByUserId(int $userId);
}
