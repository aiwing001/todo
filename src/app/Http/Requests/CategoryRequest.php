<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:10',
                Rule::unique('categories', 'name')->ignore($this->route('id')),
                ]
        ];
    }

    public function messages()
    {
    return [
        'name.required' => 'カテゴリを入力してください',
        'name.string' => 'カテゴリを文字列で入力してください',
        'name.max' => 'カテゴリを10文字以下で入力してください',
        'name.unique' => '同じカテゴリが既にあります'
        ];
    }
}
