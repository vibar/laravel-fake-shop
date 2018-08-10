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

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/cart', 'HomeController@index')->name('cart.index');
    Route::get('/orders', 'HomeController@index')->name('order.index');
    Route::get('/orders/{id}', 'HomeController@index')->name('order.show');

    Route::get('/currency/{currency}', 'CurrencyController@update')->name('currency.update');

    Route::group([
        'prefix' => 'api',
        'namespace' => 'API',
    ], function() {

        // TODO: Move to API routes

        Route::get('/products', 'ProductController@index');

        Route::get('/carts', 'CartController@index');
        Route::post('/carts/{product}', 'CartController@store');
        Route::delete('/carts/{product}', 'CartController@destroy');

        Route::get('/orders', 'OrderController@index');
        Route::post('/orders', 'OrderController@store');
        Route::get('/orders/{order}', 'OrderController@show');

    });

});


