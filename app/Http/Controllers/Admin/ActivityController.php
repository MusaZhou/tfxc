<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Activity;
use App\User;
use App\PaymentType;
use App\Province;

class ActivityController extends Controller
{
    public function index(Request $request){
		$activityList = Activity::all();
		$userList = User::all();
		$paymentTypeList = PaymentType::all();
		
		return view('admin.activity_management', ['activityList' => $activityList, 'userList' => $userList, 'paymentTypeList' => $paymentTypeList]);
	}
	
	public function showAddActivity(Request $request){
		$provinceList = Province::all();
		
		return view('admin.add_activity', ['provinceList' => $provinceList]);
	}
	
	public function addActivity(Request $request){
		$name = $request->name;
		$description = $request->description;
		$price = $request->price;
		$address = $request->address;
		$startDate = $request->startDate;
		$startTime = $request->startTime;
		$endDate = $request->endDate;
		$endTime = $request->endTime;
		$cityId = $request->city;
		$content = $request->content;
		
		$activity = new Activity();
		$activity->name = $name;
		$activity->description = $description;
		$activity->price = $price;
		$activity->address = $address;
		$activity->start_time = $startDate.' '.$startTime;
		$activity->end_time = $endDate.' '.$endTime;
		$activity->city_id = $cityId;
		$activity->content = $content;
		
		$activity->save();
		
		return redirect('/admin/activity_management');
	}
	
	public function getActivityInfoById(Request $request){
		$activityId = $request->activityId;
		
		$activity = Activity::find($activityId);
		
		$result = collect();
		$result->put('status', 1);
		$result->put('data', $activity);
		
		return $result->toJson();
	}
	
	public function showEditActivity(Request $request, $activityId){
		$provinceList = Province::all();
		$activity = Activity::find($activityId);
		
		return view('admin.edit_activity', ['provinceList' => $provinceList, 'activity' => $activity]);
	}
	
	public function editActivity(Request $request){
		$activityId = $request->activityId;
		$name = $request->name;
		$description = $request->description;
		$price = $request->price;
		$address = $request->address;
		$startDate = $request->startDate;
		$startTime = $request->startTime;
		$endDate = $request->endDate;
		$endTime = $request->endTime;
		$cityId = $request->city;
		$content = $request->content;
		
		$activity = Activity::find($activityId);
		$activity->name = $name;
		$activity->description = $description;
		$activity->price = $price;
		$activity->address = $address;
		$activity->start_time = $startDate.' '.$startTime;
		$activity->end_time = $endDate.' '.$endTime;
		$activity->city_id = $cityId;
		$activity->content = $content;
		$activity->save();
		
		return redirect('/admin/activity_management');
	}
	
	public function deleteActivity(Request $request){
		$activityId = $request->activityId;
		$activity = Activity::find($activityId);
		$activity->softDelete();
		
		return ['status' => 1];
	}
}
