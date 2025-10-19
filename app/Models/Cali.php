<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cali extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = ['type','start_date'];
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'type',
        'start_date',
        'month_00',
        'month_12',
        'month_24',
        'month_25',
        'month_36',
        'month_37',
        'month_48',
        'month_60',
        'month_99',
        'receipt_fee',
        'created_by',
        'changed_by',
    ];

    // 複合キーをまとめる
    public function getRouteKey()
    {
        return $this->type . '-' . $this->start_date;
    }
}
