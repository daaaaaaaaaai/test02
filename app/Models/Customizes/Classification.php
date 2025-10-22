<?php

namespace App\Models\Customizes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'class_code';
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'class_code',
        'class_name',
        'created_by',
        'changed_by',
    ];

    public function material(){
        return $this->hasMany(Material::class);
    }
    public function salesorder_items(){
        return $this->hasMany(SalesOrderItem::class);
    }
}
