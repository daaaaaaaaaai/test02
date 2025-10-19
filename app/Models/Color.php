<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $primaryKey = 'color_code';
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'color_code',
        'color_name1',
        'color_name2',
        'created_by',
        'changed_by',
    ];
}
