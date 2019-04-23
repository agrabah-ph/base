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

Route::get('/', 'WelcomeController@index')->name('welcome');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/notifications', 'HomeController@notifications')->name('notifications');
Route::get('/activitylogs', 'HomeController@activityLogs')->name('activity.logs');

Route::group(['middleware' => 'role:owner'], function() {
    Route::get('/users', 'HomeController@users')->name('manage.users');
    Route::get('/user-add', 'MemberController@showRegistrationForm')->name('user.add');
    Route::post('/user-create', 'MemberController@register')->name('user.create');
});

Route::group(['middleware' => ['role:client|vendor']], function() {
    Route::get('/profile', 'HomeController@profile')->name('profile');
});

Route::group(['middleware' => 'verified'], function() {
    Route::get('/purchaseorders', 'HomeController@purchaseorders')->name('purchase.orders');
    Route::get('/order-add', 'OrdersController@create')->name('purchase.add');
});

Route::get('/test', function() {echo 'test';})->middleware('verified');

Route::post('/volunteer', 'WelcomeController@volunteer');
Route::post('/contact', 'WelcomeController@contact');


