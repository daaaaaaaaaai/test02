<?php

namespace App\Models\Customizes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Margin extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'type';
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'type',
        'rate',
        'created_by',
        'changed_by',
    ];
}
