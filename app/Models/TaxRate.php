<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaxRate extends Model
{
    use HasFactory;

    protected $primaryKey = 'tax_code';
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'tax_code',
        'start_date',
        'end_date',
        'normal_rate_flg',
        'text',
        'created_by',
        'changed_by',
    ];
}
