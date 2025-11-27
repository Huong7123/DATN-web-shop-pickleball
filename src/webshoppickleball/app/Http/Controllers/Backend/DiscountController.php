<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController;
use App\Requests\Backend\DiscountRequest;
use App\Services\Backend\DiscountService;
use Illuminate\Http\Request;

class DiscountController extends BaseController
{
    public function __construct(DiscountService $service)
    {
        parent::__construct($service);
        $this->storeRequest = DiscountRequest::class;
    }
    
}
