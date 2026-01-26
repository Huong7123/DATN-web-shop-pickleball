<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController;
use App\Requests\Backend\ExclusiveConfigRequest;
use App\Services\Backend\ExclusiveConfigService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class ExclusiveConfigController extends BaseController
{
    public function __construct(ExclusiveConfigService $service)
    {
        parent::__construct($service);
        $this->storeRequest = ExclusiveConfigRequest::class;
    }
    
    public function getAll(): JsonResponse
    {
        $result = $this->service->getAll(['*'], ['discounts']);
        return response()->json($result, $result->http_code);
    }

    public function show(int $id): JsonResponse
    {
        $result = $this->service->getById($id,['*'], ['discounts']);
        return response()->json($result, $result->http_code);
    }
}
