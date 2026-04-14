<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TodoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'text' => [

            'required',
            'string',
            'max:20',
            Rule::unique('todos', 'content')->where(function ($query) {
                return $query->where('category_id', $this->category_id);
            }),
            ],
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'text.required' => 'Todoを入力してください',
            'text.string' => 'Todoを文字列で入力してください',
            'text.max' => 'Todoを20文字以下で入力してください',
            'category_id.required' => 'カテゴリーを選択してください',
            'category_id.exists' => '正しいカテゴリーを選択してください',
            'text.unique' => '同じTodoが既にあります'
        ];
    }
}