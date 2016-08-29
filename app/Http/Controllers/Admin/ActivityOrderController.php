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
}
