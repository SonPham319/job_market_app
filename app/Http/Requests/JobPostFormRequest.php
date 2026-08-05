<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobPostFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'feature_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'title' => 'required',
            'predes' => 'required',
            'description' => 'required',
            'salary' => 'required',
            'address' => 'required',
            'job_type' => 'required',
            'date' => 'required',
            'roles' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'feature_image.required' => 'Vui lòng chọn ảnh bìa',
            'feature_image.image' => 'File phải là hình ảnh',
            'feature_image.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg, gif, svg hoặc webp',
            'feature_image.max' => 'Ảnh không được vượt quá 2MB',

            'title.required' => 'Vui lòng nhập tiêu đề',
            'predes.required' => 'Vui lòng nhập mô tả ngắn',
            'description.required' => 'Vui lòng nhập mô tả',
            'salary.required' => 'Vui lòng nhập mức lương',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'job_type.required' => 'Vui lòng chọn loại công việc',
            'date.required' => 'Vui lòng chọn ngày kết thúc',
            'roles.required' => 'Vui lòng nhập yêu cầu công việc',
        ];
    }
}