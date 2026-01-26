<?php

namespace App\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ExclusiveConfigRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id'); // Lấy id cấu hình nếu là trường hợp Update

        return [
            'tier_name'    => 'required|string|max:255',
            // min_spending nên là duy nhất để tránh xung đột mức hạng (tùy chọn)
            'min_spending' => 'required|numeric|min:0', 
            // discount_id phải tồn tại trong bảng discounts
            'discount_ids'   => 'required|array|min:1',
            'discount_ids.*' => 'exists:discounts,id',
            'status'       => 'nullable|in:0,1',
        ];
    }

    public function messages(): array
    {
        return [
            'tier_name.required'    => 'Tên hạng khách hàng không được để trống.',
            'min_spending.required' => 'Mức chi tiêu tối thiểu không được để trống.',
            'min_spending.numeric'  => 'Mức chi tiêu phải là định dạng số.',
            'discount_ids.required' => 'Bạn phải chọn ít nhất một mã giảm giá cho hạng này.',
            'discount_ids.*.exists' => 'Một trong các mã giảm giá được chọn không hợp lệ.',
        ];
    }

    /**
     * Xử lý dữ liệu trước khi validate (nếu cần bỏ dấu phẩy từ formatPrice)
     */
    protected function prepareForValidation()
    {
        if ($this->has('min_spending')) {
            $this->merge([
                'min_spending' => str_replace(',', '', $this->min_spending),
            ]);
        }
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