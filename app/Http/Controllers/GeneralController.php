<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\VipOrder;
use App\ActivityOrder;
use App\VipPeriod;
use Wechat;

class GeneralController extends Controller
{
    public function emptyTableData(Request $request){
		$data = collect();
    	$result = collect();
    	
    	$result->put('data', $data);
    	
    	return $result->toJson();
	}
	
	public function vipOrderNotify(Request $request){
		$payment = Wechat::payment();
		
		$response = $payment->handleNotify(function($notify, $successful){
			$vipOrder = VipOrder::where('wx_outtrade_no', $notify->out_trade_no)->get()->first();
				
			if($vipOrder->status == 1){
				$vipOrder->status = 2;
				$vipOrder->payment_time = date('Y-m-d H:i:s');
				$vipOrder->wx_transaction_no = $notify->transaction_id;
				$vipOrder->save();
				
				$vipPeriod = new VipPeriod();
				$vipPeriod->start_date = date('Y-m-d');
				$endDate = new \DateTime(date('Y-m-d'));
				$endDate->add(new \DateInterval('P1Y'));
				$vipPeriod->end_date = $endDate->format('Y-m-d');
				$vipPeriod->vip_order_id = $vipOrder->id;
				$vipPeriod->user_id = $vipOrder->user_id;
				$vipPeriod->save();
			}
				
			return true;
		});
		
		return $response;
	}
	
	public function activityOrderNotify(Request $request){
		$payment = Wechat::payment();
		
		$response = $payment->handleNotify(function($notify, $successful){
			$activityOrder = ActivityOrder::where('wx_outtrade_no', $notify->out_trade_no)->get()->first();
		
			if($activityOrder->status == 1){
				$activityOrder->status = 2;
				$activityOrder->payment_time = date('Y-m-d H:i:s');
				$activityOrder->wx_transaction_no = $notify->transaction_id;
				$activityOrder->save();
			}
		
			return true;
		});
		
		return $response;
	}
}
