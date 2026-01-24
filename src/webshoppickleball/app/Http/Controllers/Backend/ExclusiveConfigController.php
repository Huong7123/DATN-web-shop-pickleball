<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController;
use App\Requests\Backend\ExclusiveConfigRequest;
use App\Services\Backend\ExclusiveConfigService;
use Illuminate\Http\Request;

class ExclusiveConfigController extends BaseController
{
    public function __construct(ExclusiveConfigService $service)
    {
        parent::__construct($service);
        $this->storeRequest = ExclusiveConfigRequest::class;
    }
    
}
