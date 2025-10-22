<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Requests\Traits\NumberFormatTrait;

class SalesOrderHeader extends BaseModel
{
    use HasFactory;
    use SoftDeletes;
    use NumberFormatTrait;

    protected $table = 'salesorder_headers';
    protected $primaryKey = 'order_number';
    protected $keyType = 'string';
    public $incrementing = false;

    //
    protected $fillable=[
        'order_number',
        'order_date',
        'cust_id',
        'staff_id',
        'tax_code',
        'gross_price',
        'gross_tax',
        'gross_amount',
        'text_header',
        'remarks_header',
        'order_type',
        'order_status',
        'created_by',
        'changed_by',
    ];

}
