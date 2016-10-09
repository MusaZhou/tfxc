<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Activity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Wechat;
use EasyWeChat\Payment\Order;
use QrCode;
use App\Constant;
use App\VipOrder;
use Log;

class UserController extends Controller
{
    public function personalCenter(Request $request){
    	$user = User::find($request->session()->get('userId'));
    	
    	$activityList = Activity::whereRaw('end_time > now()')->get();
    	
    	$activityOrderList = $user->paidActivityOrders();
		$myActivityList = collect();
		
		foreach($activityOrderList as $activityOrder){
			$myActivityList->push($activityOrder->activity);
		}
		
		$vipOrder = $user->latestVipOrder();
		
		$price;
		if(!empty($vipOrder)){
			$price = $vipOrder->price;
		}else{
			$price = Constant::first()->vip_price;
		}
		
		return view('user.personal_center', [
											'user' => $user,
											'activityList' => $activityList,
											'myActivityList' => $myActivityList,
											'vipPrice' => $price,
											]);
	}
	
	public function updateProfile(Request $request){
		$user = User::find($request->session()->get('userId'));
		
		$name = $request->name;
		$phone = $request->phone;
		$email = $request->email;
		$job = $request->job;
		$organization = $request->organization;
		$location = $request->location;
		$gender = $request->gender;
		
		$user->name = $name;
		$user->phone = $phone;
		$user->email = $email;
		$user->job = $job;
		$user->organization = $organization;
		$user->location = $location;
		$user->gender = $gender;
		
		$user->save();
		
		return redirect('/user/personal_center');
	}
	
	public function updatePassword(Request $request){
		$user = User::find($request->session()->get('userId'));
		$password = $request->newPassword;
		
		$user->password = bcrypt($password);
		$user->save();
		
		return redirect('/user/personal_center');
	}
	
	public function checkPassword(Request $request){
		$password = $request->password;
		$user = User::find($request->session()->get('userId'));
		
		if(Hash::check($password, $user->password)){
			return ['status' => 1];
		}else{
			return ['status' => 2];
		}
	}
	
	public function uploadHeadImage(Request $request){
		$user = User::find($request->session()->get('userId'));
		
		$file = $request->file('headImage');
		$extension = $file->getClientOriginalExtension();
		$imageUrl = '/user/head_image/'.$user->id.'-'.rand(111, 999).'.'.$extension;
		
		Storage::put($imageUrl, file_get_contents($file->getRealPath()));
		
		$user->head_image_url = $imageUrl;
		$user->save();
		
		return 1;
	}
	
	public function wepayPrepareVipRegister(Request $request){
		$user = User::find($request->session()->get('userId'));
		
		$user->job = $request->job;
		$user->organization = $request->organization;
		$user->location = $request->location;
		$user->save();
		
		$vipOrder = $user->latestVipOrder();
		
		$price;
		
		if(!empty($vipOrder)){
			$price = $vipOrder->price;
			$vipOrder->wx_outtrade_no = 'vip-user-'.$user->id.'-'.date('YmdHis');
			$vipOrder->wxpay_type = 2;
			$vipOrder->save();
		}else{
			$price = Constant::first()->vip_price;
		
			$vipOrder = new VipOrder();
			$vipOrder->user_id = $user->id;
			$vipOrder->price = $price;
			$vipOrder->status = 1;
			$vipOrder->wx_outtrade_no = 'vip-user-'.$user->id.'-'.date('YmdHis');
			$vipOrder->payment_type_id = 1;
			$vipOrder->wxpay_type = 2;
			$vipOrder->save();
		}
		
		$payment = Wechat::payment();
		
		$attributes = [
				'trade_type'       => 'NATIVE', // JSAPI，NATIVE，APP...
				'body'             => '注册VIP会员',
				'detail'           => '注册VIP会员',
				'out_trade_no'     => $vipOrder->wx_outtrade_no,
// 				'total_fee'        => $price * 100,
				'total_fee'        => 1,
				'notify_url'       => config('app.url').'/vip_order_notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地
		];
		
		$order = new Order($attributes);
		
		$result = $payment->prepare($order);
		
		if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
			$prepayId = $result->prepay_id;
			$codeUrl = $result->code_url;
// 			$codeUrl = 'abcde';
// 			$qrContent = 'weixin://wxpay/bizpayurl?sr='.$codeUrl;
			$qrContent = $codeUrl;
// 			Log::info('qr content:'.$qrContent);
			$qrImageUrl = '/QR/vip/'.$order->id.'-'.rand(111, 999).'.svg';
// 			$qrImageUrl = '/vipQR/abc'.rand(111, 999).'.svg';
			$qrSVGContent = QrCode::size(300)->generate($qrContent);
			return ['status' => 1, 'qrImageUrl' => $qrImageUrl, 'qrSVGContent' => $qrSVGContent];
		}else{
			return ['status' => 2];
		}
	}
}
