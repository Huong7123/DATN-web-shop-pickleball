<?php

namespace App\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AttributevalueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cho phép request luôn được xử lý
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'description' => 'nullable|string',
            'attribute_id' => 'required|integer|exists:attributes,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'   => 'Trường tên không được để trống.',
            'attribute_id.required' => 'Trường thuộc tính cha là bắt buộc.',
            'attribute_id.integer' => 'Trường thuộc tính cha phải là số.',
            'attribute_id.exists' => 'Thuộc tính cha không tồn tại.',
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