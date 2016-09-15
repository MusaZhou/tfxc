<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Constant;
use App\VipOrder;

class UserController extends Controller
{
    public function showNormalRegister(Request $request){
		return view('wechat.normal_register');
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
		}else{
			$price = Constant::first()->vip_price;
				
			$vipOrder = new VipOrder();
			$vipOrder->user_id = $user->id;
			$vipOrder->price = $price;
			$vipOrder->status = 1;
			$vipOrder->wx_outtrade_no = 'vip-user-'.$user->id.'-'.date('YmdHis');
			$vipOrder->payment_type_id = 1;
			$vipOrder->save();
		}
	
		return view('wechat.make_payment', ['amount' => $price, 'orderType' => 1, 'outTradeNo' => $vipOrder->wx_outtrade_no]);
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
}
