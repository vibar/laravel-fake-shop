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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/products', 'ProductController')
    ->only('index');

Route::group([
    'middleware' => 'auth'
], function() {

    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::post('/cart/{product}', 'CartController@store')->name('cart.store');
    Route::delete('/cart/{product?}', 'CartController@destroy')->name('cart.destroy');

    Route::post('/checkout', 'OrderController@store')->name('order.store');

});


