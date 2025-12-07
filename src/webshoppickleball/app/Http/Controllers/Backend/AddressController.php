<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController;
use App\Requests\Backend\AddressRequest;
use App\Services\Backend\AddressService;
use Illuminate\Http\Request;

class AddressController extends BaseController
{
    public function __construct(AddressService $service)
    {
        parent::__construct($service);
        $this->storeRequest = AddressRequest::class;
    }
    
}
