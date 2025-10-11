<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Requests\Traits\NumberFormatTrait;

class Material extends Model
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
        'color',
        'engine',
        'coo',
        'unit',
        'response_code',
        'response_rate',
        'unit_price',
        'unit_tax',
        'unit_amount',
        'gross_price',
        'gross_tax',
        'gross_amount',
        'base_price',
        'base_tax',
        'base_amount',
        'basic_margin',
        'special_margin',
        'cr1',
        'cr2',
        'r',
        'tax_code',
        'tax_rate',
        'text_material',
        'remarks_material',
        'created_by',
        'changed_by',
    ];

    public function salesorder_items(){
        return $this->hasMany(SalesOrderItem::class);
    }
    
    public function classification(){
        return $this->belongsTo(Classification::class);
    }
}
