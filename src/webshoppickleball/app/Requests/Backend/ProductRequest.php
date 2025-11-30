<?php

namespace App\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cho phép request luôn được xử lý
    }

    public function rules(): array
    {
        return [
            'image'    => 'nullable|array',
            'image.*'  => 'image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'name'      => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|integer|exists:categories,id',
            'price'     => 'nullable|numeric|min:0',
            'quantity'  => 'nullable|integer|min:0',
            'attribute_ids' => 'nullable|array',
            'attribute_ids.*' => 'integer|exists:attributes,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống.',
            'image.array' => 'Ảnh phải được gửi dưới dạng mảng.',
            'image.*.image' => 'Mỗi tệp tải lên phải là hình ảnh.',
            'image.*.mimes' => 'Hình ảnh phải thuộc định dạng: jpeg, png, jpg, webp hoặc gif.',
            'image.*.max' => 'Kích thước ảnh không được vượt quá 5MB.',
            'category_id.exists' => 'Danh mục không hợp lệ.',
            'attribute_ids.*.exists' => 'Thuộc tính không hợp lệ.',
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