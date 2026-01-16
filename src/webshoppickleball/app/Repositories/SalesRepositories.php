<?php

namespace App\Repositories;

use App\Models\Sales;
use Illuminate\Support\Collection;

class SalesRepositories
{
    protected Sales $model;

    public function __construct(Sales $model)
    {
        $this->model = $model;
    }

    // lấy tất cả npp
    public function getAllNpps()
    {
        return $this->model
            ->select('npp')
            ->distinct()
            ->get();
    }
    
    // lấy các nhánh của npp cha
    public function getChildrenByNpp(string $parentNpp)
    {
        return $this->model
            ->select('npp')
            ->where('parent', $parentNpp)
            ->distinct()
            ->get();
    }


    // lấy ds cá nhân và tổng doanh số theo npp và tháng
    public function getSaleByNppAndMonth(string $npp, string $month): ?Sales
    {
        return $this->model
            ->where('npp', $npp)
            ->where('month', $month)
            ->first();
    }

}
