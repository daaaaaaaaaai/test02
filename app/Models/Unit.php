<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;

    protected $primaryKey = 'unit';
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'unit',
        'text',
        'dimension',
        'iso_code',
        'decimals',
        'created_by',
        'changed_by',
    ];
}
