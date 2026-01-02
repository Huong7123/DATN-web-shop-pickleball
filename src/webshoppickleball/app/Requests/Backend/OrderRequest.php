<?php

namespace App\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_name'  => 'required|string|max:255',
            'user_phone' => 'required|string|max:20',
            'address'    => 'required|string|max:255',
            'description'=> 'nullable|string|max:500',
            'shipping_method' => 'required|in:0,1',
            'discount' => 'nullable|integer|min:0|max:100000000',

            // PAYMENT
            'payment_method' => 'required|in:cod,vnpay',

            // ITEMS
            'items'   => 'required|array|min:1',

            'items.*.parent_id' => 'required|integer|exists:products,id',
            'items.*.attribute_value_ids' => 'required|array|min:1',
            'items.*.attribute_value_ids.*' => 'required|integer|exists:attribute_values,id',
            'items.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'user_name.required'  => 'Tên người nhận không được để trống',
            'user_phone.required' => 'Số điện thoại không được để trống',
            'address.required'    => 'Địa chỉ giao hàng không được để trống',
            'shipping_method.required' => 'Vui lòng chọn phương thức vận chuyển',
            'shipping_method.in' => 'Phương thức vận chuyển không hợp lệ',

            'payment_method.required' => 'Vui lòng chọn phương thức thanh toán',
            'payment_method.in' => 'Phương thức thanh toán không hợp lệ',

            'items.required' => 'Danh sách sản phẩm không được để trống',

            'items.*.parent_id.required' => 'Thiếu sản phẩm cha',
            'items.*.parent_id.exists'   => 'Sản phẩm không tồn tại',

            'items.*.attribute_value_ids.required' => 'Vui lòng chọn thuộc tính',

            'items.*.quantity.required' => 'Số lượng không được để trống',
            'items.*.quantity.min'      => 'Số lượng phải lớn hơn 0',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation error',
            'errors'  => $validator->errors()
        ], 422));
    }
}
