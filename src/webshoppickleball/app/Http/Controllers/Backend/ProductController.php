<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController;
use App\Requests\Backend\ProductRequest;
use App\Services\Backend\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends BaseController
{
    public function __construct(ProductService $service)
    {
        parent::__construct($service);
        $this->storeRequest = ProductRequest::class;
    }

    public function getParentProduct(Request $request): JsonResponse
    {
        $perPage = (int) $request->get('per_page', 10);
        /** @var \App\Services\Backend\ProductService $productService */
        $productService = $this->service;

        $result = $productService->getParentProduct($perPage);

        return response()->json($result, $result->http_code);
    }

    public function getChildProduct(Request $request): JsonResponse
    {
        $parentId = (int) $request->get('parent_id');
        /** @var \App\Services\Backend\ProductService $productService */
        $productService = $this->service;

        $result = $productService->getChildProduct($parentId);

        return response()->json($result, $result->http_code);
    }
    
}
