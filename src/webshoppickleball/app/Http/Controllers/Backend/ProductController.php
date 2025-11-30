<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController;
use App\Requests\Backend\ProductRequest;
use App\Services\Backend\ProductService;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function __construct(ProductService $service)
    {
        parent::__construct($service);
        $this->storeRequest = ProductRequest::class;
    }
    
}
