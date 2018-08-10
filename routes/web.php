<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group([
    'middleware' => 'auth'
], function() {

    Route::get('/', 'ProductController@index')->name('home');

    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::post('/cart/{product}', 'CartController@store')->name('cart.store');
    Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');

    Route::get('/currency/{currency}', 'CurrencyController@update')->name('currency.update');
    Route::post('/checkout', 'OrderController@store')->name('order.store');
    Route::get('/orders', 'OrderController@index')->name('order.index');

});


