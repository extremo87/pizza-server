<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    public function boot()
    {
        Validator::extend('cart_actual', function ($attribute, $value, $parameters, $validator) {
            $ids = array_keys($value);
            $count = DB::table('products')
                ->select(DB::raw('count(id)'))
                ->whereIn('id',  $ids)
                ->count();

            return $count === count($ids);
        });
    }


}
