<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuzukiData extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = ['start_date','type','material_code'];
    protected $keyType = 'string';
    public $incrementing = false;
    //
    protected $fillable=[
        'start_date',
        'type',
        'material_code',
        'material_name',
        'maker_price',
        'response_rate',
        'basic_margin',
        'special_margin',
        'gross_price',
        'gross_amount',
        'unit_price',
        'dlv_pre',
        'weight_tax',
        'reg_stamp',
        'license_plate',
        'cali',
        'starting_price',
        'profit',
        'profit_rate',
        'moto_cost_incl_tax',
        'int_weight_tax',
        'int_reg_stamp',
        'int_license_plate',
        'int_cali',
        'cost_amount',
        'type_dlv',
        'type_cali',
        'type_theft',
        'type_cr1_1',
        'type_cr1_2',
        'type_zr_ext',
        'type_zr_moto',
        'type_store',
        'color_code01',
        'color_code02',
        'color_code03',
        'color_code04',
        'color_code05',
        'color_name01',
        'color_name02',
        'color_name03',
        'color_name04',
        'color_name05',
        'text_material',
        'remarks_material',
        'response_code',
        'tax_code',
        'created_by',
        'changed_by',
    ];

    // 複合キーをまとめる
    public function getRouteKey()
    {
        $sep = config('id_separator');
        return $this->start_date . $sep . $this->type . $sep . $this->material_code;
    }
}
