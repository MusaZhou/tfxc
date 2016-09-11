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

//------------------------------------ UserController -----------------------------------------------

Route::get('/personal_center', 'UserController@personalCenter');

Route::post('/update_profile', 'UserController@updateProfile');

Route::post('/update_password', 'UserController@updatePassword');

Route::post('/check_password', 'UserController@checkPassword');

Route::post('/upload_head_image', 'UserController@uploadHeadImage');