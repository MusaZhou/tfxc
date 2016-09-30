<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ActivityOrder;
use Log;

class ActivityOrderController extends Controller
{
    public function getActivityOrderTableData(Request $request, $activityId){
		$activityOrderList = ActivityOrder::where('activity_id', $activityId)
										->where('status', 2)
										->get();
		
		$tableData = collect();
		foreach($activityOrderList as $activityOrder){
			$activityOrderData = collect();
			$activityOrderData->put('id', $activityOrder->id);
			$activityOrderData->put('activityName', $activityOrder->activity->name);
			$activityOrderData->put('userName', $activityOrder->user->name);
			$activityOrderData->put('userPhone', $activityOrder->user->phone);
			$activityOrderData->put('price', $activityOrder->price);
			$activityOrderData->put('paymentType', $activityOrder->paymentType->name);
			$activityOrderData->put('paymentTime', $activityOrder->payment_time);
			$activityOrderData->put('note', $activityOrder->note);
			
			$tableData->push($activityOrderData);
		}
		
		Log::info('table data:'.$tableData);
		
		return ['data' => $tableData];
    }
    
    public function addActivityOrder(Request $request){
    	$activityId = $request->activityId;
    	$userId = $request->userId;
    	$paymentTypeId =$request->paymentTypeId;
    	$price = $request->price;
    	$paymentDate = $request->paymentDate;
    	$paymentTime = $request->paymentTime;
    	$note = $request->note;
    	
    	$activityOrder = new ActivityOrder();
    	$activityOrder->activity_id = $activityId;
    	$activityOrder->user_id = $userId;
    	$activityOrder->payment_type_id = $paymentTypeId;
    	$activityOrder->payment_time = $paymentDate.' '.$paymentTime;
    	$activityOrder->note = $note;
    	$activityOrder->price = $price;
    	$activityOrder->status = 2;
    	
    	$activityOrder->save();
    	
    	return redirect('/admin/activity_management');
    }
    
    public function getActivityOrderById(Request $request, $activityOrderId){
    	$activityOrder = ActivityOrder::find($activityOrderId);
    	
    	$data = collect();
    	$data->put('id', $activityOrderId);
    	$data->put('activityId', $activityOrder->activity_id);
    	$data->put('activityName', $activityOrder->activity->name);
    	$data->put('userId', $activityOrder->user_id);
    	$data->put('price', $activityOrder->price);
    	$data->put('paymentTypeId', $activityOrder->payment_type_id);
    	$data->put('paymentDateTime', $activityOrder->payment_time);
    	$data->put('note', $activityOrder->note);
    	
    	$result = collect();
    	$result->put('status', 1);
    	$result->put('data', $data);
    	
    	return $result->toJson();
    }
    
    public function editActivityOrder(Request $request){
    	$activityOrderId = $request->activityOrderId;
    	$activityId = $request->activityId;
    	$userId = $request->userId;
    	$paymentTypeId =$request->paymentTypeId;
    	$price = $request->price;
    	$paymentDate = $request->paymentDate;
    	$paymentTime = $request->paymentTime;
    	$note = $request->note;
    	
//     	Log::info('activity id:'.$activityId);
//     	Log::info('request all:'.$request->all());
    	 
    	$activityOrder = ActivityOrder::find($activityOrderId);
    	$activityOrder->activity_id = $activityId;
    	$activityOrder->user_id = $userId;
    	$activityOrder->payment_type_id = $paymentTypeId;
    	$activityOrder->payment_time = $paymentDate.' '.$paymentTime;
    	$activityOrder->note = $note;
    	$activityOrder->price = $price;
    	$activityOrder->status = 2;
    	 
    	$activityOrder->save();
    	 
    	return redirect('/admin/activity_management');
    }
    
    public function deleteActivityOrder(Request $request){
    	$activityOrder = ActivityOrder::find($request->activityOrderId);
    	$activityOrder->softDelete();
    	
    	return ['status' => 1];
    }
    
    public function changeUserActivityPrice(Request $request){
    	$price = $request->price;
    	$activityId = $request->activityId;
    	$userId = $request->userId;
    
    	$activityOrder = new ActivityOrder();
    	$activityOrder->user_id = $userId;
    	$activityOrder->activity_id = $activityId;
    	$activityOrder->price = $price;
    	$activityOrder->payment_type_id = 1;
    	$activityOrder->status = 1;
    	$activityOrder->save();
    
    	return ['status' => 1];
    }
}
