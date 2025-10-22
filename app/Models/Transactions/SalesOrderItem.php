<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;

class SalesOrderItem extends BaseModel
{

    protected $table = 'salesorder_items';
    protected $primaryKey = null;   // 複合キーは扱えない
    public $incrementing = false;

    //
    protected $fillable=[
        'order_number',
        'order_item',
        'material_code',
        'quantity',
        'unit',
        'unit_price',
        'net_price',
        'class_code',
        'text_item',
        'remarks_item',
        'created_by',
        'changed_by',
    ];

    public function materials()
    {
        return $this->belongsTo(Material::class);
    }

    public function sailesorder_headers()
    {
        return $this->belongsTo(SalesOrderHeader::class);
    }
    public function classification()
    {
        return $this->belongsTo(Clasiffication::class);
    }
}
