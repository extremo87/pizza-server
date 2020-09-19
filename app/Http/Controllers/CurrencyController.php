<?php

namespace App\Http\Controllers;

class CurrencyController extends Controller
{
    public function index()
    {
        return response([
            'USD' => [
                'rates' => [
                    'EUR' => [
                        'symbol' => '€',
                        'rate' => 1.18
                    ],
                ],
                'symbol' => '$',
            ],
            'EUR' => [
                'rates' => [
                    'USD' => [
                        'symbol' => '$',
                        'rate' => 0.84
                    ]
                ],
                'symbol' => '€',
            ],
        ]);
    }
}
