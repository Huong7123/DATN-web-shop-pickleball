<?php

namespace App\Services\Backend;

use App\Repositories\SalesRepositories;
use Carbon\Carbon;

class SaleService
{
    protected SalesRepositories $repository;

    const MONTHS = 3;
    const MIN_PARENT_PERSONAL = 5_000_000;
    const MIN_CHILD_TOTAL = 250_000_000;
    const MIN_CHILD_COUNT = 2;

    const SYSTEM_REVENUE = 1_000_000_000; // doanh thu hệ thống
    const BONUS_RATE = 0.01; // tỷ lệ quỹ thưởng / doanh thu hẹ thống

    public function __construct(SalesRepositories $repository)
    {
        $this->repository = $repository;
    }

    // kiểm tra điều kiện npp được nhận đồng chia
    public function check(): array
    {
        $npps = $this->repository->getAllNpps();

        $qualifiedNpps = [];

        foreach ($npps as $row) {

            $npp = $row->npp;

            // kiểm tra điều kiện npp cha
            if (!$this->checkParentSales($npp)) {
                continue;
            }

            // lấy các con trực tiếp
            $children = $this->repository->getChildrenByNpp($npp);

            if ($children->count() < self::MIN_CHILD_COUNT) {
                continue;
            }

            // đếm số con đạt điều kiện
            $validChildren = [];

            foreach ($children as $child) {
                if ($this->checkChildSales($child->npp)) {
                    $validChildren[] = $child->npp;
                }
            }

            // nếu đủ 2 con đạt → NPP này đạt
            if (count($validChildren) >= self::MIN_CHILD_COUNT) {
                $qualifiedNpps[] = [
                    'npp' => $npp,
                ];
            }
        }

        $totalQualified = count($qualifiedNpps);

        if ($totalQualified === 0) {
            return [];
        }

        $bonusFund = self::SYSTEM_REVENUE * self::BONUS_RATE;
        $bonusPerNpp = $bonusFund / $totalQualified;

        // gán tiền thưởng cho từng NPP
        foreach ($qualifiedNpps as &$item) {
            $item['bonus'] = $bonusPerNpp;
        }

        return $qualifiedNpps;
    }

    // kiểm tra doanh số cá nhân của npp cha
    private function checkParentSales(string $npp): bool
    {
        for ($i = 1; $i <= self::MONTHS; $i++) {

            $month = Carbon::now()
                ->subMonths($i)
                ->startOfMonth()
                ->toDateString();

            $sale = $this->repository
                ->getSaleByNppAndMonth($npp, $month);

            if (
                !$sale ||
                $sale->personal_sales < self::MIN_PARENT_PERSONAL
            ) {
                return false;
            }
        }

        return true;
    }


    // kiểm tra tổng doanh số của npp con
    private function checkChildSales(string $npp): bool
    {
        for ($i = 1; $i <= self::MONTHS; $i++) {

            $month = Carbon::now()
                ->subMonths($i)
                ->startOfMonth()
                ->toDateString();

            $sale = $this->repository
                ->getSaleByNppAndMonth($npp, $month);

            if (
                !$sale ||
                $sale->total_sales < self::MIN_CHILD_TOTAL
            ) {
                return false;
            }
        }

        return true;
    }

}