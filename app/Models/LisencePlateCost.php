<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class LisencePlateCost extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = ['prefecture','pref_etc'];
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'prefecture',
        'pref_etc',
        'purchase_price',
        'sales_price',
        'created_by',
        'changed_by',
    ];

    // 複合キーをまとめる
    public function getRouteKey()
    {
        $sep = config('id_separator');
        return $this->prefecture . $sep . $this->pref_etc;
    }
}
