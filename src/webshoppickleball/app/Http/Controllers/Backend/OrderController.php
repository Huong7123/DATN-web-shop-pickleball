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

    public function getAllOrderAdmin(Request $request): JsonResponse
    {
        $perPage = (int) $request->get('per_page', 20);
        $status  = $request->get('status');
        $orderId = $request->get('order_id');

        /** @var OrderService $ser */
        $ser = $this->service;
        $result = $ser->getAllOrderAdmin($perPage, $status, $orderId);

        return response()->json($result, $result->http_code);
    }
    
    public function getAllOrder(Request $request): JsonResponse
    {
        $filters = $request->query();

        /** @var OrderService $ser */
        $ser = $this->service;
        $result = $ser->getAllOrder($filters);

        return response()->json($result, $result->http_code);
    }

    public function getOrderDetail(int $id)
    {
        /** @var OrderService $ser */
        $ser = $this->service;
        $result = $ser->getOrderDetail($id);
        return view('layouts.Frontend.pages.profile.history-order-detail', [
            'title' => 'Chi tiết đơn hàng', 
            'order' => $result->data]);
    }
}
