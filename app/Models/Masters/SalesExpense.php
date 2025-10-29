<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesExpense extends BaseModel
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
        'dlv_pre',
        'weight_tax',
        'reg_stamp',
        'license_plate',
        'license_plate_cost',
        'setup_cost',
        'created_by',
        'changed_by',
    ];

    // 複合キーをまとめる
    public function getRouteKey()
    {
        $sep = config('id_separator');
        return $this->type . $sep . $this->start_date;
    }
}
