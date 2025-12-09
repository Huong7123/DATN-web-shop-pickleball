<?php

namespace App\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
    /**
     * Cho phép tất cả các request được xử lý.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Quy tắc validate các trường dữ liệu.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'image'           => 'nullable|array',
            'image.*'         => 'image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'name'            => 'required|string|max:255',
            'description'     => 'nullable|string',
            'category_id'     => 'nullable|integer|exists:categories,id',
            
            'price'           => 'nullable|array',
            'price.*'         => 'nullable|numeric|min:0',

            'quantity'        => 'nullable|array',
            'quantity.*'      => 'nullable|integer|min:0',
            // Thuộc tính của sản phẩm
            'attribute_ids'   => 'nullable|array',
            'attribute_ids.*' => 'integer|exists:attributes,id',

            // Giá trị thuộc tính của sản phẩm
            'attribute_value_ids'        => 'nullable|array',
            'attribute_value_ids.*'      => 'required|array',
            'attribute_value_ids.*.*'    => 'required|integer|exists:attribute_values,id',
        ];
    }

    /**
     * Thông báo lỗi custom.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'attribute_ids.array'         => 'Danh sách thuộc tính phải là mảng.',
            'attribute_ids.*.exists'      => 'Thuộc tính không hợp lệ.',

            // Attribute Values
            'attribute_value_ids.array'   => 'Danh sách giá trị thuộc tính phải là mảng.',
            'attribute_value_ids.*.exists'=> 'Giá trị thuộc tính không hợp lệ.',

        ];
    }

    /**
     * Xử lý khi validation thất bại (API trả JSON, không redirect view).
     *
     * @param  Validator  $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        $response = response()->json([
            'success' => false,
            'message' => 'Validation error',
            'errors'  => $validator->errors(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
