<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;            // 複合キー用
use Illuminate\Support\Facades\DB;              // 複合キー用

class LisencePlateCostRequest extends FormRequest
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
            'prefecture' => ['required', 'string'],
            'pref_etc' => ['required_if:prefecture, 99'],
            'purchase_price' => ['required', 'numeric', 'min:1', 'max:999999999.99'],
            'sales_price' => ['required', 'numeric', 'min:1', 'max:999999999.99'],
        ];
    }

    /**
     * 複合キーの重複チェック
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $prefecture = $this->input('prefecture');
            $pref_etc = $this->input('pref_etc');

            $query = DB::table('lisence_plate_costs')
                ->where('prefecture', $prefecture)
                ->where('pref_etc', $pref_etc ?? '');

            if ($this->isMethod('post') && $query->exists()) {
                $validator->errors()->add('prefecture', 'この条件はすでに存在します。');
            }
        });
    }

}
