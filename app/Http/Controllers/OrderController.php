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

        try {
            $order = Order::createOrder($request->all());
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 500);
        }

        return response($order, 201);
    }
}
