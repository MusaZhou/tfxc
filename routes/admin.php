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
// ----------------------------------- Login Controller ----------------------------------------

Route::get('/', 'LoginController@index');

Route::post('/login', 'LoginController@login');

//------------------------------------- User Controller -----------------------------------------

Route::get('/user_management', 'UserController@index');

Route::post('/add_user', 'UserController@addUser');

Route::get('/get_user_info_by_id', 'UserController@getUserInfoById');

Route::post('/edit_user', 'UserController@editUser');

//------------------------------------ Activity Controller ---------------------------------------

Route::get('/activity_management', 'ActivityController@index');

Route::get('/show_add_activity', 'ActivityController@showAddActivity');

Route::post('/add_activity', 'ActivityController@addActivity');

Route::get('/get_activity_info_by_id', 'ActivityController@getActivityInfoById');

Route::get('/show_edit_activity/{activityId}', 'ActivityController@showEditActivity');

Route::post('/edit_activity', 'ActivityController@editActivity');

Route::post('/delete_activity', 'ActivityController@deleteActivity');

//------------------------------------ Activity Order Controller ----------------------------------

Route::get('/get_activity_order_table_data/{activityId}', 'ActivityOrderController@getActivityOrderTableData');

Route::post('/add_activity_order', 'ActivityOrderController@addActivityOrder');

Route::get('/get_activity_order_by_id/{activityOrderId}', 'ActivityOrderController@getActivityOrderById');

Route::post('/edit_activity_order', 'ActivityOrderController@editActivityOrder');

Route::post('/delete_activity_order', 'ActivityOrderController@deleteActivityOrder');

//------------------------------------ VipPeriod Controller -----------------------------------------

Route::get('/get_vip_period_table_data/{userId}', 'VipPeriodController@getVipPeriodTableData');

Route::get('/get_vip_period_by_id/{vipPeriodId}', 'VipPeriodController@getVipPeriodById');

Route::post('/add_vip_period', 'VipPeriodController@addVipPeriod');

Route::post('/edit_vip_period', 'VipPeriodController@editVipPeriod');

Route::post('/delete_vip_period', 'VipPeriodController@deleteVipPeriod');

//------------------------------------ GeneralController ----------------------------------------------

Route::get('/get_cities_by_province', 'GeneralController@getCitiesByProvinceId');