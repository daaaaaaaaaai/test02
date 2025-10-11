<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Customer;                            // バリデーション用に使用

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    
    protected function prepareForValidation()
    {
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //
        // 送られてきたデータを確認
        //logger($this->all());       // 画面が停止しない(strage\logs\laravel.log)
        //dd($this->all());           // 画面が停止する

        // DELETEメソッドの場合はバリデーションなし
        if ($this->method() === 'DELETE') {
            return [];
        }

        $rules = [
            'name_last'       => ['required', 'string', 'max:40'],
            'name_first'      => ['nullable', 'string', 'max:40'],
            'name_last_kana'  => ['required', 'string', 'max:40'],
            'name_first_kana' => ['nullable', 'string', 'max:40'],
            'zipcode'         => ['nullable', 'string', 'max:20'],
            'prefecture'      => ['nullable', 'string'],
            'city'            => ['nullable', 'string', 'max:100'],
            'address'         => ['nullable', 'string', 'max:255'],
            'tel1'            => ['nullable', 'string', 'max:20'],
            'tel2'            => ['nullable', 'string', 'max:20'],
            'email'           => ['nullable', 'email', 'max:40'],
            'line'            => ['nullable', 'boolean'],
        ];

        logger($this->all());       // 画面が停止しない(strage\logs\laravel.log)

        // 登録（POST）のときだけ cust_code をチェック
        if ($this->isMethod('post')) {
            $rules['cust_code'] = ['nullable', 'string', 'max:10', 'unique:customers,cust_code'];
        }

        return $rules;

    }
}
