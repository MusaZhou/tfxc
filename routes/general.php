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

Route::get('/image_download/{relative_url}', 'FileController@downloadImage')->where('relative_url', '(.*)');

Route::get('/test', 'TestController@curlTest');

Route::get('/other_test', 'TestController@otherTest');

Route::any('/wechat/entry', 'Wechat\WechatController@entry');

Route::any('/wechat/create_menu', 'Wechat\WechatController@createMenu');

Route::post('/wechat/course_order_notify', 'Wechat\OrderController@courseOrderNotify');

Route::post('/wechat/book_order_notify', 'Wechat\OrderController@bookOrderNotify');
