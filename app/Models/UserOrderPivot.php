<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use App\User;

class UserOrderPivot extends Model
{
    protected $table = 'users_orders';

    protected $fillable =  [
        'order_id', 'user_id',
    ];

}
