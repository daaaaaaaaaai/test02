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
            'unit_price',
            'base_amount',
            'special_margin',
            'cr1',
            'cr2',
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
            'color' => ['nullable', 'string', 'max:40'],
            'engine' => ['nullable', 'numeric'],
            'coo' => ['nullable', 'string'],
            'unit' => ['required', 'string'],
            'response_code' => ['nullable', 'string'],
            'response_rate' => ['nullable', 'numeric'],
            'unit_price' => ['required', 'numeric', 'min:0', 'max:999999999.99'],
            'unit_tax' => ['required', 'numeric', 'min:0', 'max:999999999.99'],
            'unit_amount' => ['required', 'numeric', 'min:0', 'max:99999999999.99'],
            'sikr_price' => ['nullable', 'numeric', 'min:0', 'max:999999999.99'],
            'sikr_tax' => ['nullable', 'numeric', 'min:0', 'max:999999999.99'],
            'sikr_amount' => ['nullable', 'numeric', 'min:0', 'max:99999999999.99'],
            'base_price' => ['nullable', 'numeric', 'min:0', 'max:9999999.99'],
            'base_tax' => ['nullable', 'numeric', 'min:0', 'max:9999999.99'],
            'base_amount' => ['nullable', 'numeric', 'min:0', 'max:99999999999.99'],
            'basic_margin' => ['nullable', 'numeric', 'min:0', 'max:999999999.99'],
            'special_margin' => ['nullable', 'numeric', 'min:0', 'max:999999999.99'],
            'cr1' => ['nullable', 'numeric', 'min:0', 'max:999999999.99'],
            'cr2' => ['nullable', 'numeric', 'min:0', 'max:999999999.99'],
            'r' => ['nullable', 'numeric', 'min:0', 'max:999999999.99'],
            'tax_code' => ['required', 'string'],
            'tax_rate' => ['nullable', 'numeric'],
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
        dd($validator->errors()); // ← これでエラー内容を確認
    }
}
