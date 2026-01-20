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

            'level' => 'required|in:beginner,basic,intermediate,pro,all',
            'play_style' => 'required|in:power,control,balance,all',
            
            'price_main'      => 'required|string|max:255',
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
            // ===== IMAGE =====
            'image.array'            => 'Danh sách hình ảnh phải là một mảng.',
            'image.*.image'          => 'File tải lên phải là hình ảnh.',
            'image.*.mimes'          => 'Hình ảnh chỉ chấp nhận định dạng jpeg, png, jpg, webp hoặc gif.',
            'image.*.max'            => 'Kích thước mỗi hình ảnh không được vượt quá 5MB.',

            // ===== BASIC INFO =====
            'name.required'          => 'Tên sản phẩm không được để trống.',
            'name.string'            => 'Tên sản phẩm phải là chuỗi ký tự.',
            'name.max'               => 'Tên sản phẩm không được vượt quá 255 ký tự.',

            'description.string'     => 'Mô tả sản phẩm phải là chuỗi ký tự.',

            'category_id.integer'    => 'Danh mục sản phẩm không hợp lệ.',
            'category_id.exists'     => 'Danh mục sản phẩm không tồn tại.',

            // ===== PRICE =====
            'price_main.required'    => 'Giá sản phẩm gốc là bắt buộc.',
            'price_main.string'      => 'Giá sản phẩm gốc không hợp lệ.',
            'price_main.max'         => 'Giá sản phẩm gốc không hợp lệ.',

            'price.array'            => 'Danh sách giá của biến thể phải là một mảng.',
            'price.*.numeric'        => 'Giá của mỗi biến thể phải là số.',
            'price.*.min'            => 'Giá của biến thể không được nhỏ hơn 0.',

            // ===== QUANTITY =====
            'quantity.array'         => 'Danh sách số lượng biến thể phải là một mảng.',
            'quantity.*.integer'     => 'Số lượng của mỗi biến thể phải là số nguyên.',
            'quantity.*.min'         => 'Số lượng của biến thể không được nhỏ hơn 0.',

            // ===== ATTRIBUTES =====
            'attribute_ids.array'    => 'Danh sách thuộc tính phải là một mảng.',
            'attribute_ids.*.integer'=> 'ID thuộc tính không hợp lệ.',
            'attribute_ids.*.exists' => 'Thuộc tính không tồn tại trong hệ thống.',

            // ===== ATTRIBUTE VALUES =====
            'attribute_value_ids.array'        => 'Danh sách giá trị thuộc tính phải là một mảng.',
            'attribute_value_ids.*.array'      => 'Mỗi nhóm giá trị thuộc tính phải là một mảng.',
            'attribute_value_ids.*.*.required' => 'Giá trị thuộc tính không được để trống.',
            'attribute_value_ids.*.*.integer'  => 'Giá trị thuộc tính không hợp lệ.',
            'attribute_value_ids.*.*.exists'   => 'Giá trị thuộc tính không tồn tại trong hệ thống.',

            'level.required' => 'Vui lòng chọn trình độ người chơi.',
            'level.in'       => 'Trình độ không hợp lệ.',

            'play_style.required' => 'Vui lòng chọn phong cách chơi.',
            'play_style.in'       => 'Phong cách chơi không hợp lệ.',
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
