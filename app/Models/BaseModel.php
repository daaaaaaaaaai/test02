<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    // 全モデル共通設定をここに（例）
    protected $guarded = []; // 全カラム一括代入を許可
    // public $timestamps = false; // タイムスタンプ不要な場合
}
