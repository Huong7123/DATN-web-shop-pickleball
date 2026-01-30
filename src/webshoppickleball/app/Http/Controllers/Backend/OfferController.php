<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController;
use App\Services\Backend\OfferService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OfferController extends BaseController
{
    public function __construct(OfferService $service)
    {
        parent::__construct($service);
        
    }

    public function getOfferByUserId(Request $request): JsonResponse
    {
        /** @var OfferService $offerService */
        $offerService = $this->service;
        $result = $offerService->getOfferByUserId();

        return response()->json($result, $result->http_code);
    }
    
}
