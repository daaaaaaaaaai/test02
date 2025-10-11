<?php

namespace App\Http\Requests\Traits;

use Illuminate\Support\Facades\DB;

trait LineNumberingTrait
{
    /**
     * 次の明細番号を取得（最新番号 + 10）
     *
     * @param string $tableName 明細テーブル名
     * @param string $parentColumn ヘッダ番号カラム名
     * @param string $parentNo ヘッダ番号
     * @return string CHAR(5) ゼロ埋め済み
     */
    public function nextLineNo(string $tableName, string $parentColumn, string $parentNo): string
    {
        $last = DB::table($tableName)
            ->where($parentColumn, $parentNo)
            ->orderByDesc('item_number')
            ->first();

        return $last
            ? str_pad((int)$last->item_number + 10, 5, '0', STR_PAD_LEFT)
            : '00010';
    }

    /**
     * 既存明細の間に挿入する場合の番号計算
     *
     * @param string $prev 前の明細番号
     * @param string $next 次の明細番号
     * @return string CHAR(5)
     * @throws \Exception 空きがない場合
     */
    public function insertBetween(string $prev, string $next): string
    {
        $new = ((int)$prev + (int)$next) / 2;
        if ((int)$new == (int)$prev || (int)$new == (int)$next) {
            throw new \Exception('明細番号の空きがありません。再採番してください。');
        }
        return str_pad((int)$new, 5, '0', STR_PAD_LEFT);
    }

    /**
     * 余白不足時の再採番（10刻みに振り直す）
     *
     * @param string $tableName 明細テーブル名
     * @param string $parentColumn ヘッダ番号カラム名
     * @param string $parentNo ヘッダ番号
     */
    public function renumber(string $tableName, string $parentColumn, string $parentNo)
    {
        $details = DB::table($tableName)
            ->where($parentColumn, $parentNo)
            ->orderBy('item_number')
            ->get();

        $lineNo = 10;
        foreach ($details as $detail) {
            DB::table($tableName)
                ->where($parentColumn, $parentNo)
                ->where('item_number', $detail->line_no)
                ->update(['item_number' => str_pad($lineNo, 5, '0', STR_PAD_LEFT)]);
            $lineNo += 10;
        }
    }

}
