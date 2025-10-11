<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $primaryKey = 'country_code';
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'country_code',
        'country_name_j',
        'country_name_e',
        'country_code_a3',
        'country_code_n3',
        'created_by',
        'changed_by',
    ];
}
