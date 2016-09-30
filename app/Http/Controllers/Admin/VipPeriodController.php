<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\VipPeriod;
use App\VipOrder;

class VipPeriodController extends Controller
{
    public function getVipPeriodTableData(Request $request, $userId){
		$user = User::find($userId);
		$vipPeriodList = $user->vipPeriods;
		
		$data = collect();
		
		foreach($vipPeriodList as $vipPeriod){
			$vipOrder = $vipPeriod->vipOrder;
			
			$dataItem = collect();
			$dataItem->put('id', $vipPeriod->id);
			$dataItem->put('userName', $user->name);
			$dataItem->put('userPhone', $user->phone);
			$dataItem->put('price', $vipOrder->price);
			$dataItem->put('paymentType', $vipOrder->paymentType->name);
			$dataItem->put('paymentTime', $vipOrder->payment_time);
			$dataItem->put('startDate', $vipPeriod->start_date);
			$dataItem->put('endDate', $vipPeriod->end_date);
			$dataItem->put('note', $vipPeriod->note);
			
			$data->push($dataItem);
		}
		
		return ['data' => $data];
	}
	
	public function getVipPeriodById(Request $request, $vipPeriodId){
		$vipPeriod = VipPeriod::find($vipPeriodId);
		$user = $vipPeriod->user;
		$vipOrder = $vipPeriod->vipOrder;
		
		$data = collect();
		$data->put('id', $vipPeriod->id);
		$data->put('userId', $user->id);
		$data->put('userName', $user->name);
		$data->put('userPhone', $user->phone);
		$data->put('paymentTypeId', $vipOrder->payment_type_id);
		$data->put('price', $vipOrder->price);
		$data->put('paymentDateTime', $vipOrder->payment_time);
		$data->put('startDate', $vipPeriod->start_date);
		$data->put('endDate', $vipPeriod->end_date);
		$data->put('note', $vipPeriod->note);
		
		return ['status' => 1, 'data' => $data];
	}
	
	public function addVipPeriod(Request $request){
		$userId = $request->userId;
		$paymentTypeId = $request->paymentTypeId;
		$price = $request->price;
		$paymentDate = $request->paymentDate;
		$paymentTime = $request->paymentTime;
		$startDate = $request->startDate;
		$endDate = $request->endDate;
		$note = $request->note;
		
		$vipOrder = new VipOrder();
		$vipOrder->price = $price;
		$vipOrder->status = 2;
		$vipOrder->user_id = $userId;
		$vipOrder->payment_time = $paymentDate.' '.$paymentTime;
		$vipOrder->payment_type_id = $paymentTypeId;
		
		$vipOrder->save();
		
		$vipPeriod = new VipPeriod();
		$vipPeriod->user_id = $userId;
		$vipPeriod->start_date = $startDate;
		$vipPeriod->end_date = $endDate;
		$vipPeriod->vip_order_id = $vipOrder->id;
		$vipPeriod->note = $note;
		
		$vipPeriod->save();
		
		return redirect('/admin/user_management');
	}
	
	public function editVipPeriod(Request $request){
		$vipPeriodId = $request->vipPeriodId;
		$paymentTypeId = $request->paymentTypeId;
		$price = $request->price;
		$paymentDate = $request->paymentDate;
		$paymentTime = $request->paymentTime;
		$startDate = $request->startDate;
		$endDate = $request->endDate;
		$note = $request->note;
		
		$vipPeriod = VipPeriod::find($vipPeriodId);
		$vipOrder = $vipPeriod->vipOrder;
		
		$vipOrder->price = $price;
		$vipOrder->payment_time = $paymentDate.' '.$paymentTime;
		$vipOrder->payment_type_id = $paymentTypeId;
		
		$vipOrder->save();
		
		$vipPeriod->start_date = $startDate;
		$vipPeriod->end_date = $endDate;
		$vipPeriod->note = $note;
		
		$vipPeriod->save();
		
		return redirect('/admin/user_management');
	}
	
	public function deleteVipPeriod(Request $request){
		$vipPeriodId = $request->vipPeriodId;
		$vipPeriod = VipPeriod::find($vipPeriodId);
		$vipPeriod->softDelete();
		
		return ['status' => 1];
	}
}
