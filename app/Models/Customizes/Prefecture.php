<?php

namespace App\Models\Customizes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'prefecture';
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'prefecture',
        'text',
        'created_by',
        'changed_by',
    ];
}
