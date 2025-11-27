<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController;
use App\Requests\Backend\CategoryRequest;
use App\Services\Backend\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function __construct(CategoryService $service)
    {
        parent::__construct($service);
        $this->storeRequest = CategoryRequest::class;
    }
    
}
