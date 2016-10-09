<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Activity;
use App\User;
use Log;
use QrCode;
use App\ActivityOrder;
use EasyWeChat\Payment\Order;
use Wechat;

class ActivityController extends Controller
{
    public function getActivityDetailById(Request $request){
    	$user = User::find($request->session()->get('userId'));
    	
		$activity = Activity::find($request->activityId);
		$activityResult = collect();
		
		$activityResult->put('title', $activity->name);
		$activityResult->put('content', $activity->content);
		
		$activityOrder = $user->latestActivityOrder($activity->id);
		
		$price;
		if(!empty($activityOrder)){
			$price = $activityOrder->price;
		}else{
			$price = $activity->price;
		}
		
		$activityResult->put('price', $price);
		
		return ['status' => 1, 'data' => $activityResult];
	}
	
	public function wepayPrepareSubscribeActivity(Request $request){
		$user = User::find($request->session()->get('userId'));
		
		$activityId = $request->activityId;
		$activity = Activity::find($activityId);
		
		$activityOrder = $user->latestActivityOrder($activityId);
		
		$price;
		
		if(!empty($activityOrder)){
			$price = $activityOrder->price;
			$activityOrder->wx_outtrade_no = 'activity-'.$activity->id.'-user-'.$user->id.'-'.date('YmdHis');
			$activityOrder->wxpay_type = 2;
			$activityOrder->save();
		}else{
			$price = $activity->price;
		
			$activityOrder = new ActivityOrder();
			$activityOrder->user_id = $user->id;
			$activityOrder->price = $price;
			$activityOrder->status = 1;
			$activityOrder->wx_outtrade_no = 'activity-'.$activity->id.'-user-'.$user->id.'-'.date('YmdHis');
			$activityOrder->payment_type_id = 1;
			$activityOrder->wxpay_type = 2;
			$activityOrder->activity_id = $activity->id;
			$activityOrder->save();
		}
		
		$payment = Wechat::payment();
		
		$attributes = [
				'trade_type'       => 'NATIVE', // JSAPI，NATIVE，APP...
				'body'             => '报名活动',
				'detail'           => '报名活动',
				'out_trade_no'     => $activityOrder->wx_outtrade_no,
// 				'total_fee'        => $price * 100,
				'total_fee'        => 1,
				'notify_url'       => config('app.url').'/activity_order_notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地
		];
		
		$order = new Order($attributes);

		$result = $payment->prepare($order);

		if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
			$prepayId = $result->prepay_id;
			$codeUrl = $result->code_url;
			Log::info('code url:'.$codeUrl);
// 		$codeUrl = 'abcde';
// 			$qrContent = 'weixin://wxpay/bizpayurl?sr='.$codeUrl;
			$qrContent = $codeUrl;
// 			Log::info('qr content:'.$qrContent);
			$qrImageUrl = '/QR/activity/'.$order->id.'-'.rand(111, 999).'.svg';
// 		$qrImageUrl = '/vipQR/abc'.rand(111, 999).'.svg';
			$qrSVGContent = QrCode::size(300)->generate($qrContent);
			return ['status' => 1, 'qrImageUrl' => $qrImageUrl, 'qrSVGContent' => $qrSVGContent];
		}else{
			return ['status' => 2];
		}
	}
}
