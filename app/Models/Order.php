<?php

namespace App\Models;

use App\User;
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
            'lastName' => 'required|max:255|min:3',
            'address' => 'required|max:255|min:10',
            'phone' => 'required|max:11|min:11',
            'deliveryFee' => 'required|numeric',
            'currency' => ['required', Rule::in(config('pizza.currencies'))],
            'paymentMethod' => ['required', Rule::in(config('pizza.paymentMethods'))],
            'cart' => 'required|cart_actual'
        ];
    }

    public static function createOrder($data, $user) {

        DB::beginTransaction();

        try {
            $order = self::create(self::prepareOrderToDB($data));
            $order->items()->createMany(self::prepareOrderItemsToDB($order, $data['cart']));

            if ($user) {
                UserOrderPivot::create([
                    'order_id' => $order->id,
                    'user_id' =>  $user->id
                ]);
            }

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

    public static function getUserOrders(User $user) {

        $orders = $user->orders;

        $orderIds = $orders->pluck('id');

        $products = DB::table('products')
            ->join('order_items', 'product_id', '=','products.id')
            ->whereIn('order_items.order_id', $orderIds )
            ->get();

        foreach ($orders as $key => $order) {
            $orders[$key]->items = $products->where('order_id', $order->id);
        }

        return $orders;

    }




}
