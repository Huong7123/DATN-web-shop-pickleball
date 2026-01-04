<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController;
use App\Requests\Backend\OrderRequest;
use App\Services\Backend\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OrderController extends BaseController
{
    public function __construct(OrderService $service)
    {
        parent::__construct($service);
        $this->storeRequest = OrderRequest::class;
    }
    
    public function getAllOrder(Request $request): JsonResponse
    {
        $filters = $request->query();

        /** @var OrderService $ser */
        $ser = $this->service;
        $result = $ser->getAllOrder($filters);

        return response()->json($result, $result->http_code);
    }
}
