<?php

namespace App\Http\Requests\Traits;

trait RemoveCommaTrait
{
    /**
     * 指定された数値フィールドのカンマを除去する
     */
    protected function removeCommaFromFields(array $numericFields = []): void
    {
        $data = [];

        // 数値項目：カンマ除去＆数値判定
        foreach ($numericFields as $field) {
            if ($this->has($field)) {
                $value = $this->input($field);
                $data[$field] = str_replace(',', '', $value);
            }
        }

        $this->merge($data);
    }
}
