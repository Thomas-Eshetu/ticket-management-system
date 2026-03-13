<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
   protected $table = 'suppliers';

   protected $fillable = [
    'company_name',
    'trade_type',
    'email',
    'phone',
    'country',
    'city',
    'address',
    'tin_no',
    'status',
   ];
}
