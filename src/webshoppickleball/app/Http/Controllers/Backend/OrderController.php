<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController;
use App\Requests\Backend\OrderRequest;
use App\Services\Backend\OrderService;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    public function __construct(OrderService $service)
    {
        parent::__construct($service);
        $this->storeRequest = OrderRequest::class;
    }
    
}
