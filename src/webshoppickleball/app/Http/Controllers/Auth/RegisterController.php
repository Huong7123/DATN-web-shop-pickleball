<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Requests\Auth\RegisterRequest;
use App\DTO\DataResult;
use App\Requests\Auth\ActiveRequest;
use App\Services\Auth\ResgiterService;
use Illuminate\Http\Request;

class RegisterController extends Controller{
    private ResgiterService $resgiterService;

    public function __construct(ResgiterService $resgiterService)
    {
        $this->resgiterService = $resgiterService;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->resgiterService->register($request->validated());

            $result = new DataResult(
                'Đăng ký thành công. Vui lòng kiểm tra email để nhận OTP.',
                201,
                $user
            );

            return response()->json($result);
            
        } catch (\Exception $e) {
            $result = new DataResult(
                $e->getMessage(),
                400,
                null
            );

            return response()->json($result);
        }

    }

    public function active(ActiveRequest $request)
    {
        try {
            $data = $request->validated();

            $success = $this->resgiterService->active($data['email'],$data['otp_code']);

            if ($success) {
                return response()->json([
                    'status'  => true,
                    'message' => 'Kích hoạt tài khoản thành công!'
                ], 200);
            }

            return response()->json([
                'status'  => false,
                'message' => 'Không thể kích hoạt tài khoản'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 400);
        }

    }

    public function resendOtp(Request $request)
    {
        try {
            $email = $request->email;

            $user = $this->resgiterService->resendOtp($email);

            $result = new DataResult(
                'Chúng tôi đã gửi mã OTP tới email của bạn!',
                200,
                $user
            );

            return response()->json($result);

        } catch (\Exception $e) {
            $result = new DataResult(
                $e->getMessage(),
                400,
                null
            );

            return response()->json($result);
        }

    }

}
