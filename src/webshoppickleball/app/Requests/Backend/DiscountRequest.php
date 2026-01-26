<?php

namespace App\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DiscountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id'); // Lấy id từ route để loại trừ khi update

        return [
            'title'               => 'required|string|max:255',
            'code'                => 'required|string|max:50|unique:discounts,code,' . $id,
            'description'         => 'nullable|string',
            'discount_type'       => 'required|in:percentage,fixed',
            'discount_value'      => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) {
                    if ($this->discount_type === 'percentage' && $value > 100) {
                        $fail('Phần trăm giảm giá không được lớn hơn 100%.');
                    }
                },
            ],
            'max_discount_amount' => 'nullable|numeric|min:0',
            'min_order_value'     => 'nullable|numeric|min:0',
            'min_total_spent'     => 'nullable|numeric|min:0',
            'is_first_order'      => 'nullable|in:0,1,true,false',
            'start_date'          => 'required|date|before_or_equal:end_date',
            'end_date'            => 'required|date|after_or_equal:start_date',
            'usage_limit'         => 'nullable|integer|min:1',
            'status'              => 'nullable|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'    => 'Tiêu đề không được để trống.',
            'code.required'     => 'Mã giảm giá không được để trống.',
            'code.unique'       => 'Mã giảm giá này đã tồn tại.',
            'discount_type.in'  => 'Loại giảm giá phải là percentage hoặc fixed.',
            'start_date.before_or_equal' => 'Ngày bắt đầu không được sau ngày kết thúc.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Lỗi xác thực dữ liệu',
            'errors'  => $validator->errors()
        ], 422));
    }
}