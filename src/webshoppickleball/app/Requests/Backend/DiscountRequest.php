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
        return [
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp,gif',
            'title'        => 'required|string|max:255',
            'code'         => 'required|string|max:50|unique:discounts,code,',
            'description'  => 'nullable|string',
            'percent_off'  => 'required|numeric|min:0|max:100',
            'start_date'   => 'required|date|before_or_equal:end_date',
            'end_date'     => 'required|date|after_or_equal:start_date',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'Tên ưu đãi không được để trống.',
            'code.required'        => 'Mã giảm giá không được để trống.',
            'code.unique'          => 'Mã giảm giá đã tồn tại.',
            'percent_off.required' => 'Vui lòng nhập phần trăm giảm giá.',
            'percent_off.min'      => 'Phần trăm giảm giá không được nhỏ hơn 0%.',
            'percent_off.max'      => 'Phần trăm giảm giá không được lớn hơn 100%.',
            'start_date.required'  => 'Vui lòng chọn ngày bắt đầu.',
            'end_date.required'    => 'Vui lòng chọn ngày kết thúc.',
            'start_date.before_or_equal' => 'Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc.',
            'end_date.after_or_equal'    => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.',
            'image.image'          => 'Tệp tải lên phải là hình ảnh.',
            'image.mimes'          => 'Hình ảnh phải thuộc định dạng: jpeg, png, jpg, webp hoặc gif.',
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
