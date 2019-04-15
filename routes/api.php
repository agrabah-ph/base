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

Route::group(['middleware' => ['auth:api', 'role:client']], function() {
    Route::get('orders', 'OrdersController@index');
    Route::post('order', 'OrdersController@store');
});
