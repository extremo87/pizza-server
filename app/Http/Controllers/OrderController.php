<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, Order::rules());

        $data = $request->all();

        return response(Order::createOrder($data), 201);
    }
}
