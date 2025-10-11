<?php

namespace App\Http\Requests\Traits;

trait NumberFormatTrait
{
    /**
     * ゼロを除去して文字列を返す
     * null が渡された場合は空文字を返す
     *
     * @param string|null $value
     * @return string
     */
    public function formatNumber(?string $value): string
    {
        return $value !== null ? ltrim($value, '0') : '';
    }

    /**
     * モデルのカラム名を指定してフォーマット
     *
     * @param string $column
     * @return string
     */
    public function formatColumn(string $column): string
    {
        return $this->formatNumber($this->{$column} ?? null);
    }
}
