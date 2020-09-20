<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class OrderItem extends Model
{

    protected $fillable =  [
        'order_id', 'product_id', 'quantity', 'created_at', 'updated_at',
    ];

}
