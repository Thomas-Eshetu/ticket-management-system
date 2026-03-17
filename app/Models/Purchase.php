<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchases';
    protected $fillable = [
        'supplier_id',
        'product_id',
        'user_id',
        'purchaser_id',
        'quantity',
        'unit_price',
        'total_price',
        'tax_percent',
        'tax',
        'grand_total',
        'purchase_date',
        'status',
    ];
}
