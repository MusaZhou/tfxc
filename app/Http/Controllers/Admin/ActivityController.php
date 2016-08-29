<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Activity;

class ActivityController extends Controller
{
    public function index(Request $request){
		$activityList = Activity::all();
		
		return view('admin.activity_management', ['activityList' => $activityList]);
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
		
		$activity = new Activity();
		$activity->name = $name;
		$activity->description = $description;
		$activity->price = $price;
		$activity->address = $address;
		$activity->start_time = $startDate.' '.$startTime;
		$activity->end_time = $endDate.' '.$endTime;
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
		
		$activity = Activity::find($activityId);
		$activity->name = $name;
		$activity->description = $description;
		$activity->price = $price;
		$activity->address = $address;
		$activity->start_time = $startDate.' '.$startTime;
		$activity->end_time = $endDate.' '.$endTime;
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
