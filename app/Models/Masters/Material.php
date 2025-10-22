<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Requests\Traits\NumberFormatTrait;

class Material extends BaseModel
{
    use HasFactory;
    use SoftDeletes;
    use NumberFormatTrait;

    protected $primaryKey = 'material_code';
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'material_code',
        'material_name',
        'class_code',
        'model',
        'engine',
        'coo',
        'unit',
        'payment_type',
        'cali_type',
        'theft_type',
        'cr1_type1',
        'cr1_type2',
        'zrex_type',
        'zrmt_type',
        'color_code01',
        'color_code02',
        'color_code03',
        'color_code04',
        'color_code05',
        'text_material',
        'remarks_material',
        'created_by',
        'changed_by',
    ];

}
