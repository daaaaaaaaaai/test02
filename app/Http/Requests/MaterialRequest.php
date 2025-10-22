<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Traits\RemoveCommaTrait;      // Traitを使用
use App\Models\Material;                            // バリデーション用に使用

use Illuminate\Contracts\Validation\Validator;              // エラー確認用
use Illuminate\Http\Exceptions\HttpResponseException;       // エラー確認用

class MaterialRequest extends FormRequest
{
    use RemoveCommaTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        // 数値項目だけを指定（カンマ除去対象）
        $this->removeCommaFromFields([
            'engine',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // 送られてきたデータを確認
        //logger($this->all());       // 画面が停止しない(strage\logs\laravel.log)
        //dd($this->all());           // 画面が停止する

        // DELETEメソッドの場合はバリデーションなし
        if ($this->method() === 'DELETE') {
            return [];
        }

        $rules = [
            //
            'material_name' => ['required', 'string', 'max:60'],
            'class_code' => ['required', 'string'],
            'model' => ['nullable', 'string', 'max:40'],
            'engine' => ['nullable', 'numeric', 'max:9999'],
            'coo' => ['nullable', 'string'],
            'unit' => ['required', 'string'],
            'payment_type' => ['nullable', 'string'],
            'cali_type' => ['nullable', 'string'],
            'theft_type' => ['nullable', 'string'],
            'cr1_type1' => ['nullable', 'string'],
            'cr1_type2' => ['nullable', 'string'],
            'zrex_type' => ['nullable', 'string'],
            'zrmt_type' => ['nullable', 'string'],
            'color_code01' => ['nullable', 'string'],
            'color_code02' => ['nullable', 'string'],
            'color_code03' => ['nullable', 'string'],
            'color_code04' => ['nullable', 'string'],
            'color_code05' => ['nullable', 'string'],
            'text_material' => ['nullable', 'string', 'max:255'],
            'remarks_material' => ['nullable', 'string', 'max:1024'],
        ];

        // 登録（POST）のときだけ material_code をチェック
        if ($this->isMethod('post')) {
            $rules['material_code'] = ['nullable', 'string', 'max:40', 'unique:materials,material_code'];
        }

        //logger($this->all());
        //logger($rules);
        //dd($rules);

        return $rules;

    }

    protected function failedValidation(Validator $validator)
    {
        //dd($validator->errors()); // ← これでエラー内容を確認
        //logger($this->all());       // 画面が停止しない(strage\logs\laravel.log)
    }
}
