<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class Order extends Model
{

    const STATUS_NEW = 'new';
    const STATUS_PAID = 'paid';
    const STATUS_CLOSED = 'closed';


    protected $fillable =  [
        'id', 'fullname', 'address', 'phone', 'status', 'payment', 'currency',
        'currency', 'delivery_fee', 'total', 'created_at', 'updated_at',

    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }



    public static function rules() {
       return [
            'firstName' => 'required|max:255|min:2',
            'lastName' => 'required|max:255|min:2',
            'address' => 'required|max:255|min:2',
            'phone' => 'required|max:18|min:18',
            'deliveryFee' => 'required|numeric',
            'currency' => ['required', Rule::in(config('pizza.currencies'))],
            'paymentMethod' => ['required', Rule::in(config('pizza.paymentMethods'))],
            'cart' => 'required|cart_actual'
        ];
    }

    public static function createOrder($data) {

        DB::beginTransaction();

        try {
            $order = self::create(self::prepareOrderToDB($data));
            $order->items()->createMany(self::prepareOrderItemsToDB($order, $data['cart']));

            DB::commit();
            $order->items;

            return $order;

        } catch (\Exception $e) {
            return $e;
            DB::rollBack();
        }
    }

    private static function prepareOrderToDB($data) {
        return [
            'fullname' => "{$data['firstName']} {$data['lastName']}",
            'address' => $data['address'],
            'phone' => trim(preg_replace("/\D/", "", ($data['phone']))),
            'status' => Order::STATUS_NEW,
            'payment' => $data['paymentMethod'],
            'currency' => $data['currency'],
            'delivery_fee' => $data['deliveryFee'],
            'total' => Order::calculateTotal($data['cart'], $data['deliveryFee']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

    }

    private static function prepareOrderItemsToDB(Order $order, $cart) {
        $orderItems = [];

        foreach ($cart as $item) {
            $orderItems[] = [
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['qty'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        return $orderItems;

    }

    private static function calculateTotal($cart, $fee) {
        $totalProducts = 0;

        foreach ($cart as $item) {
            $totalProducts += $item['price'] * $item['qty'];
        }

        return $totalProducts + $fee;
    }




}
