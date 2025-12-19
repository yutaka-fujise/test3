<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWeightLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'date' => ['required', 'date'],

            'weight' => [
                'required',
                'numeric',
                'max:9999',
                'regex:/^\d+(\.\d)?$/',
            ],

            'calorie' => [
                'required',
                'numeric',
            ],

            'exercise_time' => [
                'required',
            ],

            'exercise_content' => [
                'nullable',
                'string',
                'max:120',
            ],
        ];
    }

    /**
     * エラーメッセージ
     */
    public function messages(): array
    {
        return [
            'date.required' => '日付を入力してください',

            'weight.required' => '体重を入力してください',
            'weight.numeric' => '数字で入力してください',
            'weight.max' => '4桁までの数字で入力してください',
            'weight.regex' => '小数点は1桁で入力してください',

            'calorie.required' => '摂取カロリーを入力してください',
            'calorie.numeric' => '数字で入力してください',

            'exercise_time.required' => '運動時間を入力してください',

            'exercise_content.max' => '120文字以内で入力してください',
        ];
    }
}
