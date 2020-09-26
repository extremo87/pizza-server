<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Exception;
use JWTAuth;
use \Tymon\JWTAuth\Exceptions\TokenInvalidException;
use \Tymon\JWTAuth\Exceptions\TokenExpiredException;
use App\Models\Order;

class OrderController extends Controller
{

    public function create(Request $request)
    {
        $this->validate($request, Order::rules());

        $user = null;

        if ($request->headers->has('Authorization')) {
            try {
                $user = JWTAuth::parseToken()->authenticate();
            } catch (Exception $e) {
                if ($e instanceof TokenInvalidException){
                    return response(['message' => 'Token is Invalid'], 401);
                }else if ($e instanceof TokenExpiredException){
                    return response(['message' => 'Token is Expired'], 401);
                }
            }
        }

        try {
            $order = Order::createOrder($request->all(), $user);

        } catch (\Exception $exception) {
            return response(['message' => $exception->getMessage()], 500);
        }

        return response(['data' => $order], 201);
    }

    public function get(Request $request)
    {
        $user = auth()->user();

        $orders = Order::getUserOrders($user);

        return response(['data' => $orders]);
    }
}
