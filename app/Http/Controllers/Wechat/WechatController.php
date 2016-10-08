<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Wechat;

class WechatController extends Controller
{
	public function entryPoint(){
		$wechatServer = Wechat::server();
    	$wechatServer->setMessageHandler(function($message){
    		return '欢迎使用';
    	});
    	
    	return $wechatServer->serve();
	}
	
	public function createMenu(Application $wechat){
		$menu = Wechat::menu();
		
		$buttons = [
				[
						"type" => "view",
						"name" => "注册会员",
						"url"  => config('app.url'."/wechat/show_normal_register"),
				],
				[
						"type" => "view",
						"name" => "当前活动",
						"url"  => config('app.url'."/wechat/activity_list"),
				],
				[
						"name"       => "个人中心",
						"sub_button" => [
								[
										"type" => "view",
										"name" => "个人信息",
										"url"  => config('app.url'."/wechat/personal_info"),
								],
								[
										"type" => "view",
										"name" => "活动历史",
										"url"  => config('app.url'."/wechat/personal_activity_history"),
								],
						],
				],
		];
		
		$menu->add($buttons);
	}
	
	public function makePayment(Request $request){
// 		$amount = $request->amount;
// 		$orderType = $request->orderType;
// 		$outTradeNo = $request->outTradeNo;
// 		$config = $request->config;
// 		return view('wecaht.make_payment', ['amount' => $price,
// 											'orderType' => 1,
// 											'outTradeNo' => $vipOrder->wx_outtrade_no,
// 											'config' => $config,
// 											]);
	}
}
