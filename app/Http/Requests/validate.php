<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
        {
           $rules = [
               'name' =>'sometimes|required',
               'email' => 'sometimes|required|email',
               'password' => 'sometimes|required|min:8',
               'title' =>'sometimes|required|max:255',
               'description'=> 'sometimes|required|max:255',
               'content'=> 'sometimes|required',
               'comment'=> 'sometimes|required|max:255',
               'filter_comment'=> 'sometimes|required|max:50',
           ];
           if ($this->hasFile('image')) {
                $rules['image'] = 'mimes:jpeg,png,jpg,gif,svg,webp|max:2048';
            }
            return $rules;
        }
        
    
    public function messages(): array
    {
        return [
            'name.required' => 'Tên là bắt buộc.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirm' => 'Mật khẩu không khớp.',
            'image.mimes' => 'Hình ảnh phải thuộc loại: jpeg, png, jpg, gif, svg, webp.',
            'image.max' => 'Kích thước hình ảnh không vượt quá 2048 kb.',
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.max' => 'Tiêu đề phải ít hơn 256 kí tự.',
            'description.required' => 'Mô tả là bắt buộc.',
            'description.max' => 'Mô tả phải ít hơn 256 kí tự.',
            'content.required' => 'Nội dung là bắt buộc.',
            'comment.required' => 'Nội dung bình luận là bắt buộc.',
            'comment.max' => 'Bình luận phải ít hơn 256 kí tự.',
            'filter_comment.required' => 'Nội dung là bắt buộc.',
            'filter_comment.max' => 'Nội dung phải ít hơn 51 kí tự.',
        ];
    }
}
