<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\DTO\DataResult;
use App\Requests\Auth\ForgotPasswordRequest;
use App\Requests\Auth\ResetPassWordRequest;
use App\Services\Auth\ForgotPasswordService;

class ForgotPasswordController extends Controller
{
    private ForgotPasswordService $forgotPasswordService;

    public function __construct(ForgotPasswordService $forgotPasswordService)
    {
        $this->forgotPasswordService = $forgotPasswordService;
    }

    /**
     * Gửi OTP
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $data = $request->validated();
        $result = $this->forgotPasswordService->forgotPassword($data['email']);
        return response()->json($result, $result->http_code);
    }

    /**
     * Reset mật khẩu
     */
    public function resetPassword(ResetPassWordRequest $request)
    {
        $data = $request->validated();
        $result = $this->forgotPasswordService->resetPassword($data['email'], $data['password']);
        return response()->json($result, $result->http_code);
    }
}
