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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api', 'role:owner']], function() {
    Route::get('user-search', 'UserController@search');
    Route::get('user-info/{user_id}', 'UserController@getUserInfo');
    Route::get('user-get', 'UserController@get');
    Route::get('province', 'LocationsController@province');
});

/**
 * Allow Client and owner to use Purchase Orders
 */

Route::group(['middleware' => ['auth:api', 'role:client|owner']], function() {
    Route::post('order', 'OrdersController@store');
    Route::get('/order/{order}', 'OrdersController@show');
    Route::get('/userPurchaseOrders', 'OrdersController@userPurchaseOrders');
});

/**
 * Display all Orders to owner client and vendor
 */

Route::group(['middleware' => ['auth:api', 'role:owner|vendor|client']], function() {
    Route::get('orders', 'OrdersController@index');
});
