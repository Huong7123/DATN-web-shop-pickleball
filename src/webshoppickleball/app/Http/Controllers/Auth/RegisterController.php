<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Requests\Auth\RegisterRequest;
use App\Requests\Auth\ActiveRequest;
use App\Services\Auth\ResgiterService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private ResgiterService $registerService;

    public function __construct(ResgiterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function register(RegisterRequest $request)
    {
        $result = $this->registerService->register($request->validated());
        return response()->json($result, $result->http_code);
    }

    public function active(ActiveRequest $request)
    {
        $data = $request->validated();
        $result = $this->registerService->active($data['email'], $data['otp_code']);
        return response()->json($result, $result->http_code);
    }

    public function resendOtp(Request $request)
    {
        $result = $this->registerService->resendOtp($request->email);
        return response()->json($result, $result->http_code);
    }
}
