<?php

namespace App\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cho phép request luôn được xử lý
    }

    public function rules(): array
    {
        return [
            'user_name'  => 'required|string|max:255',
            'user_phone' => 'required|string|max:20',
            'address'    => 'nullable|string|max:255',
            'description'=> 'nullable|string|max:500',

            'items'          => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'user_name.required'  => 'Tên người nhận không được để trống',
            'user_phone.required' => 'Số điện thoại người nhận không được để trống',

            'items.required'         => 'Danh sách sản phẩm không được để trống',
            'items.array'            => 'Danh sách sản phẩm phải là mảng',
            'items.*.product_id.required' => 'Sản phẩm không được để trống',
            'items.*.product_id.exists'   => 'Sản phẩm không tồn tại',
            'items.*.quantity.required'   => 'Số lượng không được để trống',
            'items.*.quantity.integer'    => 'Số lượng phải là số nguyên',
            'items.*.quantity.min'        => 'Số lượng phải lớn hơn 0',
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