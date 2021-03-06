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
//------------------------------------ LoginController ---------------------------------------------

Route::get('/', 'LoginController@index');

Route::post('/login', 'LoginController@login');

Route::get('/logout', 'LoginController@logout');

//------------------------------------ UserController -----------------------------------------------

Route::get('/personal_center', 'UserController@personalCenter');

Route::post('/update_profile', 'UserController@updateProfile');

Route::post('/update_password', 'UserController@updatePassword');

Route::post('/check_password', 'UserController@checkPassword');

Route::post('/upload_head_image', 'UserController@uploadHeadImage');

Route::post('/wepay_prepare_vip_register', 'UserController@wepayPrepareVipRegister');

//----------------------------------- ActivityController --------------------------------------------

Route::get('/get_activity_detail_by_id', 'ActivityController@getActivityDetailById');

Route::post('/wepay_prepare_subscribe_activity', 'ActivityController@wepayPrepareSubscribeActivity');