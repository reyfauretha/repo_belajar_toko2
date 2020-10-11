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
Route::post('/register','UserController@register');
Route::post('/login', 'UserController@login');

Route::group(['middleware' => ['jwt.verify']], function ()
{
    Route::group(['middleware' => ['api.superadmin']], function()
    {
        Route::delete('/customers/{id}', 'CustomersController@destroy');
        Route::delete('/product/{id}', 'ProductController@destroy');
        Route::delete('/orders/{id}', 'OrdersController@destroy');
        Route::delete('/transaksi/{id}', 'TransaksiController@destroy');
    });

    Route::group(['middleware' => ['api.admin']], function()
    {
        Route::post('/customers','CustomersController@store');
        Route::put('/customers/{id}', 'CustomersController@update');

        Route::post('/product','ProductController@store');
        Route::put('/product/{id}', 'ProductController@update');

        Route::post('/orders','OrdersController@store');
        Route::put('/orders/{id}', 'OrdersController@update');

        Route::post('/transaksi','TransaksiController@store');
        Route::put('/transaksi/{id}', 'TransaksiController@update');
    });

    Route::get('/customers', 'CustomersController@show');
    Route::get('/customers/{id}', 'CustomersController@detail');

    Route::get('/product', 'productController@show');
    Route::get('/product/{id}', 'ProductController@detail');

    Route::get('/orders', 'OrdersController@show');
    Route::get('/orders/{id}', 'OrdersController@detail');
    
    Route::get('/transaksi', 'TransaksiController@show');
    Route::get('/transaksi/{id}', 'TransaksiController@detail');
});