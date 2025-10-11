<?php

namespace App\Http\Requests\Traits;

use Illuminate\Support\Facades\DB;

trait NumberingTrait
{
    /**
     * 次の伝票番号を取得
     *
     * @param string $type 伝票種別 ('estimate', 'order', 'invoice', etc)
     * @return string CHAR(10) ゼロ埋め済み
     * @throws \Exception 番号範囲が存在しない場合
     */
    public function nextNumber(string $type, int $digits = 10): string
    {
        return DB::transaction(function () use ($type, $digits) {
            // 番号範囲テーブルをロックして取得
            $seq = DB::table('number_ranges')
                ->lockForUpdate()
                ->where('number_range', $type)
                ->first();

            if (!$seq) throw new \Exception("Number sequence {$type} not found");

            // 現番号+1
            $next = str_pad((int)$seq->number_current + 1, $digits, '0', STR_PAD_LEFT);

            // 終了番号を超えた場合は開始番号に戻す
            if ($next > $seq->number_to) {
            $next = str_pad((int)$seq->number_from, $digits, '0', STR_PAD_LEFT);
            }

            // 現番号更新
            DB::table('number_ranges')->where('number_range', $type)->update(['number_current' => $next]);

            return $next;
        });
    }

}
