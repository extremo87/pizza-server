<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BindPossibleOrders
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  $event
     * @return void
     */
    public function handle($event)
    {

        $user = $event->user;

        if (empty($user->phone_verified_at)) {
            Log::error("USER_BINDING_ORDERS: Attempt to accessing orders without phone verification USER ID {$user->id}");
            return;
        }

        $orders = Order::where('phone', $user->phone)->get();

        if (count($orders) > 0) {
            foreach ($orders as $order) {
                try {
                    DB::table('users_orders')->insert([
                        'user_id' => $event->user->id,
                        'order_id' => $order->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                } catch (\Exception $exception) {
                    Log::error("USER_BINDING_ORDERS: USER_ID {$user->id} {$exception->getMessage()}");
                }
            }
        }

    }

}
