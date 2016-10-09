<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Activity;
use App\ActivityOrder;
use App\User;
use Wechat;
use EasyWeChat\Payment\Order;

class ActivityController extends Controller
{
    public function activityList(Request $request){
		$activityList = Activity::whereRaw('end_time > now()')->get();
		
		return view('wechat.activity_list', ['activityList' => $activityList]);
	}
	
	public function activityDetail(Request $request, $activityId){
		$activity = Activity::find($activityId);
		
		return view('wechat.activity_detail', ['activity' => $activity]);
	}
	
	public function subscribeActivity(Request $request){
		$user = User::find($request->session()->get('userId', 1));
		$activityId = $request->activityId;
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
			
// 			$paymentSessionObj = [
// 									'amount' => $price,
// 									'orderType' => 2,
// 									'outTradeNo' => $activityOrder->wx_outtrade_no,
// 									'config' => $config,
// 			];
			
// 			$request->session()->put('payment', $paymentSessionObj);
				
// 			return redirect('/wechat/make_payment');
			
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
	
	public function showActivitySubscribeSuccess(Request $request){
		return view('wechat.activity_subscribe_success');
	}
}
