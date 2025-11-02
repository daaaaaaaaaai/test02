<?php

namespace App\Models\Customizes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    //
    use HasFactory;

    protected $primaryKey = 'status';
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'status',
        'text',
        'created_by',
        'changed_by',
    ];
}
