<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'LoginController@index');

Route::post('/login', 'LoginController@login');

//------------------------------------- User Controller -----------------------------------------

Route::get('/user_management', 'UserController@index');

Route::post('/add_user', 'UserController@addUser');

Route::get('/get_user_info_by_id', 'UserController@getUserInfoById');

Route::post('/edit_user', 'UserController@editUser');

//------------------------------------ Activity Controller ---------------------------------------

Route::get('/activity_management', 'ActivityController@index');

Route::post('/add_activity', 'ActivityController@addActivity');

Route::get('/get_activity_info_by_id', 'ActivityController@getActivityInfoById');

Route::post('/edit_activity', 'ActivityController@editActivity');

Route::post('/delete_activity', 'ActivityController@deleteActivity');