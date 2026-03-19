<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
     protected $table = 'purchases';
    protected $fillable = [
        'supplier_id',
        'user_id',
        'total_price',
        'tax',
        'grand_total',
        'purchase_date',
        'status',
    ];

      public function items()
{
    return $this->hasMany(PurchaseItems::class);
}

public function supplier()
{
    return $this->belongsTo(Supplier::class);
}

}
