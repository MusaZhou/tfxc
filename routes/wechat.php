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

//----------------------  UserController ---------------------------------

Route::get('/show_normal_register', 'UserController@showNormalRegister');

Route::get('/show_normal_register', 'UserController@showVipRegister');

Route::get('/personal_info', 'UserController@personalInfo');

Route::get('/personal_activity_history', 'UserController@activityHistory');

//---------------------- ActivityController -------------------------------

Route::get('/activity_list', 'ActivityController@activityList');

Route::get('/activity_detail/{activityId}', 'ActivityController@activityDetail');

Route::get('/show_subscribe_activity/{activityId}', 'ActivityController@showSubscribeActivity');