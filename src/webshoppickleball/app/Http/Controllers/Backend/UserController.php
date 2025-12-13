<?php

namespace App\Http\Controllers\Backend;

use App\DTO\DataResult;
use App\Http\Controllers\Backend\BaseController;
use App\Requests\Auth\RegisterRequest;
use App\Services\Backend\UserService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function __construct(UserService $service)
    {
        parent::__construct($service);
        $this->storeRequest = RegisterRequest::class;
    }

    public function updatePassword(Request $request, int $id): JsonResponse
    {
        $data = $request->only([
            'current_password',
            'new_password',
            'confirm_password',
        ]);

        $validator = Validator::make($data, [
            'current_password' => 'required|string',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',      // chữ thường
                'regex:/[A-Z]/',      // chữ hoa
                'regex:/[0-9]/',      // số
                'regex:/[@$!%*#?&]/', // ký tự đặc biệt
            ],
            'confirm_password' => 'required|same:new_password',
        ], [
            'confirm_password.same' => 'Mật khẩu xác nhận không khớp',
        ]);

        if ($validator->fails()) {
            return response()->json(
                new DataResult(
                    'Dữ liệu không hợp lệ',
                    422,
                    $validator->errors()
                ),
                422
            );
        }

        /** @var \App\Services\Backend\UserService $userService */
        $userService = $this->service;
        $result = $userService->updatePassword($id, $data);
        return response()->json($result, $result->http_code);
    }
    
}
