<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;            // 複合キー用
use Illuminate\Support\Facades\DB;              // 複合キー用

class TypeValueRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // DELETEメソッドの場合はバリデーションなし
        if ($this->method() === 'DELETE') {
            return [];
        }

        return [
            //
            'type' => ['required', 'string', 'max:2'],
            'value' => ['required', 'string', 'max:2'],
            'text' => ['required', 'string'],
        ];
    }

    /**
     * 複合キーの重複チェック
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $type = $this->input('type');
            $value = $this->input('value');

            $query = DB::table('type_values')
                ->where('type', $type)
                ->where('value', $value ?? '');

            if ($this->isMethod('post') && $query->exists()) {
                $validator->errors()->add('type', 'この条件はすでに存在します。');
            }
        });
    }
}
