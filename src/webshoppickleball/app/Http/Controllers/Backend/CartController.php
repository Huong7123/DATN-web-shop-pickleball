<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController;
use App\Requests\Backend\CartRequest;
use App\Services\Backend\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends BaseController
{
    public function __construct(CartService $service)
    {
        parent::__construct($service);
        $this->storeRequest = CartRequest::class;
    }

    public function deleteItems(Request $request): JsonResponse
    {
        $productIds = $request->input('product_ids', []);

        /** @var \App\Services\Backend\CartService $cartService */
        $cartService = $this->service;

        $result = $cartService->deleteItems($productIds);

        return response()->json($result, $result->http_code);
    }
    
}
