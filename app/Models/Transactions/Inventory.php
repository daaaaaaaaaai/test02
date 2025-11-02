<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends BaseModel
{
    use SoftDeletes;

    //
    protected $fillable=[
        'material_code',
        'material_name',
        'model',
        'color_code',
        'color_name1',
        'color_name2',
        'body_number',
        'doc_date',
        'quantity',
        'unit',
        'maker_price',
        'grpss_price',
        'typ_dlv',
        'typ_cali',
        'typ_theft',
        'typ_cr1_1',
        'typ_cr1_2',
        'typ_zr_ext',
        'typ_zr_moto',
        'text_inv',
        'remarks_inv',
        'status_inv',
        'mat_doc_no',
        'item_number',
        'created_by',
        'changed_by',
    ];
}
