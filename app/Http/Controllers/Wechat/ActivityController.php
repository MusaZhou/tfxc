<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Activity;
use App\ActivityOrder;
use App\User;

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
	
	public function subscribeActivity(Request $request, $activityId){
		$user = User::find($request->session()->get('userId', 1));
		$activity = Activity::find($activityId);
		
		$activityOrder = $user->latestActivityOrder($activity->id);
		
		$price;
		
		if(!empty($activityOrder)){
			$price = $activityOrder->price;
		}else{
			$price = $activity->price;
		
			$activityOrder = new ActivityOrder();
			$activityOrder->user_id = $user->id;
			$activityOrder->activity_id = $activity->id;
			$activityOrder->price = $price;
			$activityOrder->status = 1;
			$activityOrder->wx_outtrade_no = 'activity-'.$activity->id.'-user-'.$user->id.'-'.date('YmdHis');
			$activityOrder->payment_type_id = 1;
			$activityOrder->save();
		}
		
		return view('wechat.make_payment', ['amount' => $price, 'orderType' => 2, 'outTradeNo' => $activityOrder->wx_outtrade_no]);
	}
}
