<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController;
use App\Requests\Auth\RegisterRequest;
use App\Services\Backend\UserService;

class UserController extends BaseController
{
    public function __construct(UserService $service)
    {
        parent::__construct($service);
        $this->storeRequest = RegisterRequest::class;
    }
    
}
