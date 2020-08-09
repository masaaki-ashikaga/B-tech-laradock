<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == 'mycart/review' | $this->path() == 'edit/review'){
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
            'review_title' => 'required|max:100',
            'review' => 'required|max:500',
            'evaluation' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'review_title.required' => 'レビュータイトルは必須項目です。',
            'review_title.max:100' => 'レビュータイトルは100文字以内で入力してください。',
            'review.required' => '商品レビューは必須項目です。',
            'review.max:500' => '商品レビューは500文字以上で入力してください。',
            'evaluation.required' => '評価を選択してください',
        ];
    }
}
