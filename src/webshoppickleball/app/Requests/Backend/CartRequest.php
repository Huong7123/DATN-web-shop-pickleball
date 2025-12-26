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

            'items.*.parent_id' => 'required|integer|exists:products,id',
            'items.*.attribute_value_ids' => 'required|array|min:1',
            'items.*.attribute_value_ids.*' => 'integer|exists:attribute_values,id',

            'items.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'items.*.parent_id.required' => 'Sản phẩm không hợp lệ',
            'items.*.parent_id.exists'   => 'Sản phẩm không tồn tại',

            'items.*.attribute_value_ids.required' => 'Vui lòng chọn thuộc tính',
            'items.*.attribute_value_ids.array'    => 'Thuộc tính không hợp lệ',
            'items.*.attribute_value_ids.min'      => 'Phải chọn ít nhất 1 thuộc tính',

            'items.*.quantity.required' => 'Vui lòng nhập số lượng',
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