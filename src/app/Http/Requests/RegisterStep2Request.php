<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStep2Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_weight' => [
                'required',
                'numeric',
                'max:9999',
                'regex:/^\d+(\.\d{1})?$/',
            ],
            'goal_weight' => [
                'required',
                'numeric',
                'max:9999',
                'regex:/^\d+(\.\d{1})?$/',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'current_weight.required' => '体重を入力してください',
            'current_weight.numeric'  => '数字で入力してください',
            'current_weight.max'      => '4桁までの数字で入力してください',
            'current_weight.regex'    => '小数点は1桁で入力してください',

            'goal_weight.required' => '体重を入力してください',
            'goal_weight.numeric'  => '数字で入力してください',
            'goal_weight.max'      => '4桁までの数字で入力してください',
            'goal_weight.regex'    => '小数点は1桁で入力してください',
        ];
    }
}
