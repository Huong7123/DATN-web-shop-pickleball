<?php

namespace App\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cho phép request luôn được xử lý
    }

    public function rules(): array
    {
        return [
            'address_line'  => 'required|string|max:255',
            'user_name'     => 'required|string|max:255',
            'user_phone'    => 'required|string|max:255',
            'ward'          => 'required|string|max:255',
            'district'      => 'required|string|max:255',
            'province'      => 'required|string|max:255',
            'is_default'    => 'nullable|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'address_line.required' => 'Vui lòng nhập địa chỉ chi tiết.',
            'user_name.required' => 'Vui lòng nhập tên người nhận.',
            'user_phone.required' => 'Vui lòng nhập số điện thoại người nhận.',
            'ward.required' => 'Vui lòng chọn phường/xã.',
            'district.required' => 'Vui lòng chọn quận/huyện.',
            'province.required' => 'Vui lòng chọn tỉnh/thành phố.',
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