<?php

namespace App\Models\Customizes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusValue extends Model
{
    //
    use HasFactory;

    protected $primaryKey = ['status','value'];
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'status',
        'value',
        'text',
        'created_by',
        'changed_by',
    ];

    // 複合キーをまとめる
    public function getRouteKey()
    {
        $sep = config('id_separator');
        return $this->status . $sep . $this->value;
    }

}
