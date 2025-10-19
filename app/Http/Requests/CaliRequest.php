<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;            // 複合キー用
use Illuminate\Support\Facades\DB;              // 複合キー用

class CaliRequest extends FormRequest
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
            'start_date' => ['required', 'date'],
            'month_00' => ['nullable'],
            'month_12' => ['nullable'],
            'month_24' => ['nullable'],
            'month_25' => ['nullable'],
            'month_36' => ['nullable'],
            'month_37' => ['nullable'],
            'month_48' => ['nullable'],
            'month_60' => ['nullable'],
            'month_99' => ['nullable'],
            'receipt_fee' => ['nullable'],
        ];
    }

    /**
     * 複合キーの重複チェック
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $type = $this->input('type');
            $start_date = $this->input('start_date');

            $query = DB::table('calis')
                ->where('type', $type)
                ->where('start_date', $start_date ?? '');

            if ($this->isMethod('post') && $query->exists()) {
                $validator->errors()->add('type', 'この条件はすでに存在します。');
            }
        });
    }
}
