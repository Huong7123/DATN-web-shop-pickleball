<?php

namespace App\Http\Controllers\Backend;

use App\Services\Backend\SaleService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;


class SaleController extends Controller
{
    protected SaleService $saleService;

    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }
    
    public function check(): JsonResponse
    {
        $result = $this->saleService->check();

        return response()->json([
            'success' => !empty($result),
            'data'    => $result,
        ]);
    }

}
