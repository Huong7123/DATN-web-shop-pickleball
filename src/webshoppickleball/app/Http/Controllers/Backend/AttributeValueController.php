<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController;
use App\Requests\Backend\AttributevalueRequest;
use App\Services\Backend\AttributeValueService;
use Illuminate\Http\Request;

class AttributeValueController extends BaseController
{
    public function __construct(AttributeValueService $service)
    {
        parent::__construct($service);
        $this->storeRequest = AttributevalueRequest::class;
    }
    
}
