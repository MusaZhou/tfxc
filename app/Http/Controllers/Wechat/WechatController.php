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
	
	public function createMenu(){
		$menu = Wechat::menu();
		
		$buttons = [
				[
						"type" => "view",
						"name" => "注册会员",
						"url"  => config('app.url')."/wechat/show_normal_register",
				],
				[
						"type" => "view",
						"name" => "当前活动",
						"url"  => config('app.url')."/wechat/activity_list",
				],
				[
						"name"       => "个人中心",
						"sub_button" => [
								[
										"type" => "view",
										"name" => "个人信息",
										"url"  => config('app.url')."/wechat/personal_info",
								],
								[
										"type" => "view",
										"name" => "活动历史",
										"url"  => config('app.url')."/wechat/personal_activity_history",
								],
						],
				],
		];
		
		$menu->add($buttons);
	}
	
	public function makePayment(Request $request, $orderType = 1, $activityId = 0){
		
		if($orderType == 1){
			$user = User::find($request->session()->get('userId', 1));
			$user->job = $request->job;
			$user->organization = $request->organization;
			$user->location = $request->location;
			$user->save();
			
			$vipOrder = $user->latestVipOrder();
			
			$price;
			
			if(!empty($vipOrder)){
				$price = $vipOrder->price;
				$vipOrder->wx_outtrade_no = 'vip-user-'.$user->id.'-'.date('YmdHis');
				$vipOrder->wxpay_type = 1;
				$vipOrder->save();
					
			}else{
				$price = Constant::first()->vip_price;
			
				$vipOrder = new VipOrder();
				$vipOrder->user_id = $user->id;
				$vipOrder->price = $price;
				$vipOrder->status = 1;
				$vipOrder->wx_outtrade_no = 'vip-user-'.$user->id.'-'.date('YmdHis');
				$vipOrder->payment_type_id = 1;
				$vipOrder->wxpay_type = 1;
				$vipOrder->save();
			}
			
			$payment = Wechat::payment();
			
			$attributes = [
					'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
					'body'             => '注册VIP会员',
					'detail'           => '注册VIP会员',
					'out_trade_no'     => $vipOrder->wx_outtrade_no,
					// 				'total_fee'        => $price * 100,
					'total_fee'        => 1,
					'notify_url'       => config('app.url').'/vip_order_notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地
					'openid' 		   => $user->open_id,
			];
			
			$order = new Order($attributes);
			
			$result = $payment->prepare($order);
			
			if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
				$prepayId = $result->prepay_id;
				$config = $payment->configForJSSDKPayment($prepayId);
				$js = Wechat::js();
				return view('wechat.make_payment', ['amount' => $price,
													'orderType' => 1,
													'outTradeNo' => $vipOrder->wx_outtrade_no,
													'config' => $config,
													'js' => $js,
													]);
			}else{
				return '';
			}
		}else if($orderType == 2){
			$user = User::find($request->session()->get('userId', 1));
			$activity = Activity::find($activityId);
			
			$activityOrder = $user->latestActivityOrder($activity->id);
			
			$price;
			
			if(!empty($activityOrder)){
				$price = $activityOrder->price;
				$activityOrder->wx_outtrade_no = 'activity-'.$activity->id.'-user-'.$user->id.'-'.date('YmdHis');
				$activityOrder->wxpay_type = 1;
				$activityOrder->save();
			}else{
				$price = $activity->price;
			
				$activityOrder = new ActivityOrder();
				$activityOrder->user_id = $user->id;
				$activityOrder->activity_id = $activity->id;
				$activityOrder->price = $price;
				$activityOrder->status = 1;
				$activityOrder->wx_outtrade_no = 'activity-'.$activity->id.'-user-'.$user->id.'-'.date('YmdHis');
				$activityOrder->payment_type_id = 1;
				$activityOrder->wxpay_type = 1;
				$activityOrder->save();
			}
			
			$payment = Wechat::payment();
			
			$attributes = [
					'trade_type'       => 'JSAPI', // JSAPI，NATIVE，APP...
					'body'             => '报名活动',
					'detail'           => '报名活动',
					'out_trade_no'     => $activityOrder->wx_outtrade_no,
					// 				'total_fee'        => $price * 100,
					'total_fee'        => 1,
					'notify_url'       => config('app.url').'/activity_order_notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地
					'openid' 		   => $user->open_id,
			];
			
			$order = new Order($attributes);
			
			$result = $payment->prepare($order);
			
			if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
				$prepayId = $result->prepay_id;
				$config = $payment->configForJSSDKPayment($prepayId);
					
				$js = Wechat::js();
				return view('wechat.make_payment', ['amount' => $price,
													'orderType' => 2,
													'outTradeNo' => $activityOrder->wx_outtrade_no,
													'config' => $config,
													'js' => $js,
				]);
			}else{
				return '';
			}
		}
	}
}
