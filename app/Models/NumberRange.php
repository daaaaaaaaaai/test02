<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NumberRange extends Model
{
    use HasFactory;

    protected $primaryKey = 'number_range';
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'number_range',
        'number_from',
        'number_to',
        'number_current',
        'text',
        'created_by',
        'changed_by',
    ];
}
