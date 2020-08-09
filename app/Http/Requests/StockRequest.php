<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == 'stock/create'){
            return true;
        } else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'detail' => 'required|max:500',
            'fee' => 'required|integer',
            'imgpath' => 'max:200000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名は必須項目です。',
            'name.max:100' => '商品名は100文字以内で入力してください。',
            'detail.required' => '商品詳細は必須項目です。',
            'detail.max:500' => '商品詳細は500文字以内で入力してください。',
            'fee.required' => '金額は必須項目です。',
            'fee.integer' => '金額は数字で入力してください。',
            'imgpath.max:200000' => 'サイズは200MB以内です。',
        ];
    }
}
