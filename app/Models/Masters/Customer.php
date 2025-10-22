<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Requests\Traits\NumberFormatTrait;

class Customer extends BaseModel
{
    use HasFactory;
    use SoftDeletes;
    use NumberFormatTrait;

    protected $primaryKey = 'cust_code';
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'cust_code',
        'name_last',
        'name_first',
        'name_last_kana',
        'name_first_kana',
        'zipcode',
        'prefecture',
        'city',
        'address',
        'tel1',
        'tel2',
        'email',
        'line',
        'created_by',
        'changed_by',
    ];

    public function salesorder_headers(){
        return $this->hasMany(SalesOrderHeader::class);
    }
}
