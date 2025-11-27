<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController;
use App\Requests\Backend\AttributeRequest;
use App\Services\Backend\AttributeService;
use Illuminate\Http\Request;

class AttributeController extends BaseController
{
    public function __construct(AttributeService $service)
    {
        parent::__construct($service);
        $this->storeRequest = AttributeRequest::class;
    }
    
}
