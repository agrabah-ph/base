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

Route::group(['middleware' => 'role:owner'], function() {
    Route::get('/users', 'HomeController@users')->name('manage.users');
    Route::get('/user-add', 'MemberController@showRegistrationForm')->name('user.add');
    Route::post('/user-create', 'MemberController@register')->name('user.create');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/notifications', 'HomeController@notifications')->name('notifications');
Route::get('/activitylogs', 'HomeController@activityLogs')->name('activity.logs');

Route::get('/test', function() {echo 'test';})->middleware('verified');