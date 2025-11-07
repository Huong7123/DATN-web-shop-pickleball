<?php

namespace App\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cho phép request luôn được xử lý
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => [
                'required',
                'confirmed', // cần có password_confirmation
                'min:8',
                'regex:/[a-z]/',      // chứa ít nhất 1 chữ thường
                'regex:/[A-Z]/',      // chứa ít nhất 1 chữ hoa
                'regex:/[0-9]/',      // chứa ít nhất 1 số
                'regex:/[@$!%*#?&]/'  // chứa ít nhất 1 ký tự đặc biệt
            ],
            'phone' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Tên người dùng không được để trống.',
            'name.max'          => 'Tên người dùng không vượt quá 255 ký tự.',
            'email.required'    => 'Email không được để trống.',
            'email.email'       => 'Email không hợp lệ.',
            'email.unique'      => 'Email đã tồn tại.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min'      => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.regex'    => 'Mật khẩu phải chứa ít nhất một chữ thường, một chữ hoa, một số và một ký tự đặc biệt.',
            'password.confirmed'=> 'Xác nhận mật khẩu không khớp.',
            'phone.required'    => 'Vui lòng nhập số điện thoại.',
        ];
    }

    /**
     * Khi validate fail — với API ta trả JSON (không redirect view).
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $payload = [
            'success' => false,
            'message' => 'Validation error',
            'errors'  => $validator->errors()
        ];

        throw new HttpResponseException(response()->json($payload, 422));
    }
}