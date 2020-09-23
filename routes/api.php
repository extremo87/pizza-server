<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('/products', 'ProductController@index')->name('products');
Route::get('/currencies', 'CurrencyController@index')->name('currencies');
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@authenticate');

Route::group(['middleware' => ['sanitize']], function () {
    Route::post('/orders', 'OrderController@create')->name('create');
});

Route::group(['middleware' => ['jwt']], function() {
    Route::get('/user', 'UserController@getAuthenticatedUser');
    Route::get('/orders', 'OrderController@get');
});


