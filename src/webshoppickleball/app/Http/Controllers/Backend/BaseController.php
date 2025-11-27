<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\Backend\BaseService;
use App\DTO\DataResult;

class BaseController
{
    protected BaseService $service;
    protected string $storeRequest;

    public function __construct(BaseService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        $filters = $request->query();
        unset($filters['page'], $filters['per_page']);

        $perPage = $request->get('per_page');

        $result = $this->service->paginateWithFilters($filters, $perPage);

        return response()->json($result, $result->http_code);
    }

    public function show(int $id): JsonResponse
    {
        $result = $this->service->getById($id);
        return response()->json($result, $result->http_code);
    }

    public function store(): JsonResponse
    {
        $validated = app($this->storeRequest)->validated();
        $result = $this->service->create($validated);
        return response()->json($result, $result->http_code);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $data = $request->all();
        $result = $this->service->update($id, $data);
        return response()->json($result, $result->http_code);
    }

    public function destroy(int $id): JsonResponse
    {
        $result = $this->service->delete($id);
        return response()->json($result, $result->http_code);
    }
}
