<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Activity;

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
	
	public function showSubscribeActivity(Request $request, $activityId){
		$activity = Activity::find($activityId);
		
		return view('wechat.subscribe_activity', ['activity' => $activity]);
	}
}
