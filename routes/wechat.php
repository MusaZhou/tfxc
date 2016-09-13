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

Route::post('/register_normal_user', 'UserController@registerNormalUser');

Route::get('/show_vip_register', 'UserController@showVipRegister');

Route::post('/register_vip_user', 'UserController@registerVipUser');

Route::get('/personal_info', 'UserController@personalInfo');

Route::get('/personal_activity_history', 'UserController@activityHistory');

//---------------------- ActivityController -------------------------------

Route::get('/activity_list', 'ActivityController@activityList');

Route::get('/activity_detail/{activityId}', 'ActivityController@activityDetail');

Route::get('/subscribe_activity/{activityId}', 'ActivityController@subscribeActivity');