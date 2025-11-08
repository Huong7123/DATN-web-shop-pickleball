<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\DTO\DataResult;
use App\Requests\Auth\ForgotPasswordRequest;
use App\Requests\Auth\ResetPassWordRequest;
use App\Services\Auth\ForgotPasswordService;
use Exception;

class ForgotPasswordController extends Controller{
    private ForgotPasswordService $forgotPasswordService;

    public function __construct(ForgotPasswordService $forgotPasswordService)
    {
        $this->forgotPasswordService = $forgotPasswordService;
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        try {
            // Lấy dữ liệu từ request đã được validate
            $data = $request->validated();

            $user = $this->forgotPasswordService->forgotPassword($data['email']);
            $result = new DataResult(
                'Chúng tôi đã gửi mã OTP. Vui lòng kiểm tra email để nhận OTP.',
                200,
                $user
            );

            return response()->json($result);
        } catch (Exception $e) {
            return response()->json(new DataResult(
                $e->getMessage(),
                400
            ));
        }
    }

    public function ResetPassword(ResetPassWordRequest $request){
        try {
            $data = $request->validated();

            $result = $this->forgotPasswordService->ResetPassword($data['email'],$data['password']);

            return response()->json(new DataResult(
                'Đổi mật khẩu thành công',
                200,
                ['success' => $result]
            ));

        } catch (Exception $e) {
            return response()->json(new DataResult(
                $e->getMessage(),
                400
            ), 400);
        }
    }
}