<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\DTO\DataResult;
use App\Requests\Auth\LoginRequest;
use App\Services\Auth\LoginService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private LoginService $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $result = $this->loginService->login($data['email'], $data['password']);
        return response()->json($result, $result->http_code);
    }

    public function me()
    {
        $result = $this->loginService->me();
        return response()->json($result, $result->http_code);
    }

    public function refresh()
    {
        $result = $this->loginService->refresh();
        return response()->json($result, $result->http_code);
    }

    public function logout()
    {
        $result = $this->loginService->logout();
        return response()->json($result, $result->http_code);
    }
}
