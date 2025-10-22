<?php

namespace App\Models\Customizes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseRate extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'response_code';
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'response_code',
        'start_date',
        'end_date',
        'response_rate',
        'text',
        'created_by',
        'changed_by',
    ];
}
