<?php

namespace App\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cho phép request luôn được xử lý
    }

    public function rules(): array
    {
        return [
            'items' => 'required|array|min:1',

            'items.*.variant_id' => 'required|integer|exists:product_variants,id',
            'items.*.quantity'   => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'items.required'  => 'Danh sách sản phẩm không được để trống',
            'items.array'     => 'Danh sách sản phẩm phải là mảng',

            'items.*.variant_id.required' => 'Biến thể sản phẩm không được để trống',
            'items.*.variant_id.exists'   => 'Biến thể sản phẩm không tồn tại',

            'items.*.quantity.required' => 'Số lượng không được để trống',
            'items.*.quantity.integer'  => 'Số lượng phải là số nguyên',
            'items.*.quantity.min'      => 'Số lượng phải lớn hơn 0',
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