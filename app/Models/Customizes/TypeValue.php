<?php

namespace App\Models\Customizes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeValue extends BaseModel
{
    use HasFactory;

    protected $primaryKey = ['type','value'];
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'type',
        'value',
        'text',
        'created_by',
        'changed_by',
    ];

    // 複合キーをまとめる
    public function getRouteKey()
    {
        $sep = config('id_separator');
        return $this->type . $sep . $this->value;
    }

}
