<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $primaryKey = 'type';
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'type',
        'text',
        'created_by',
        'changed_by',
    ];
}
