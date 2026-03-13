<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'product_type',
        'product_name',
        'product_brand',
        'product_code',
        'unit',
        'quantity',
        'status',
    ];
}
