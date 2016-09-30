<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Constant;
use App\VipOrder;
use Wechat;
use EasyWeChat\Payment\Order;

class UserController extends Controller
{
    public function showNormalRegister(Request $request){
    	$user = User::find($request->session()->get('userId', 1));
    	if($user->status == 1){
    		return view('wechat.error',['error' => '您已经是我们的普通会员了:)']);
    	}else if($user->status == 0){
    		return view('wechat.normal_register');
    	}
	}
	
	public function registerNormalUser(Request $request){
		$user = User::find($request->session()->get('userId', 1));
		$user->name = $request->name;
		$user->phone = $request->phone;
		$user->email = $request->email;
		$password = '123456';
		$user->password = bcrypt($password);
		$user->save();
		
		return view('wechat.normal_register_success', ['password' => $password]);
	}
	
	public function showVipRegister(Request $request){
		$user = User::find($request->session()->get('userId', 1));
		$vipOrder = $user->latestVipOrder();

		$price;
		if(!empty($vipOrder)){
			$price = $vipOrder->price;
		}else{
			$price = Constant::first()->vip_price;
		}
		
		return view('wechat.vip_register', ['user' => $user, 'price' => $price]);
	}
	
	public function registerVipUser(Request $request){
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
				'total_fee'        => $price * 100,
				'notify_url'       => config('app.url').'/vip_order_notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地
		];
		
		$order = new Order($attributes);

		$result = $payment->prepare($order);

		if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
			$prepayId = $result->prepay_id;
			$config = $payment->configForJSSDKPayment($prepayId);
			
			return view('wechat.make_payment', ['amount' => $price, 
												'orderType' => 1, 
												'outTradeNo' => $vipOrder->wx_outtrade_no,
												'config' => $config,
												]);
		}else{
			return '';
		}
	}
	
	public function personalInfo(Request $request){
		$user = User::find($request->session()->get('userId', 1));
		
		return view('wechat.personal_info', ['user' => $user]);
	}
	
	public function activityHistory(Request $request){
		$user = User::find($request->session()->get('userId', 1));
		$activityOrderList = $user->activityOrders;
		$activityList = collect();
		
		foreach($activityOrderList as $activityOrder){
			$activityList->push($activityOrder->activity);
		}
		
		return view('wechat.activity_history', ['activityList' => $activityList, 'user' => $user]);
	}
	
	public function showVipRegisterSuccess(Request $request){
		return view('vip_register_success');
	}
}
