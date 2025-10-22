<?php

namespace App\Models\Customizes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemoteCost extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'distance';
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'distance',
        'cost',
        'created_by',
        'changed_by',
    ];
}
