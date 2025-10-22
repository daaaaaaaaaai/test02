<?php

namespace App\Models\Customizes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JapaneseCalendar extends BaseModel
{
    use HasFactory;

    protected $primaryKey = 'start_date';
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'start_date',
        'end_date',
        'japanese_date',
        'created_by',
        'changed_by',
    ];
}
