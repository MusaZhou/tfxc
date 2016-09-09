<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];
	
	public function vipPeriods(){
		return $this->hasMany('App\VipPeriod');
	}
	
	public function vipOrders(){
		return $this->hasMany('App\VipOrder');
	}
	
	public function activityOrders(){
		return $this->hasMany('App\ActivityOrder');
	}
	
	public function softDelete(){
		foreach($this->vipPeriods as $vipPeriod){
			$vipPeriod->softDelete();
		}
		
		foreach($this->vipOrders as $vipOrder){
			$vipOrder->softDelete();
		}
		
		foreach($this->activityOrders as $activityOrder){
			$activityOrder->softDelete();
		}
	}
	
	public function isVip(){
		$vipPeriods = $this->vipPeriods()->whereRaw('start_date <= now() AND end_date >= now()')->get();
		
		return !$vipPeriods->isEmpty();
	}
	
	public function systemCreatedOrder(){
		$vipOrders = VipOrder::where('user_id', $this->id)
							->where('status', 3)
							->orderBy('id', 'desc')
							->get();
		
		if($vipOrders->count() > 0){
			return $vipOrders->last();
		}else{
			return null;
		}
	}
	
	public function currentVipPeriod(){
		$vipPeriods = $this->vipPeriods()->whereRaw('start_date <= now() AND end_date >= now()')->get();
		
		if(!$vipPeriods->isEmpty()){
			return $vipPeriods->last();
		}else{
			return null;
		}
	}
	
	public function getActivityOrder($activityId){
		$activityOrder = ActivityOrder::where('user_id', $this->id)
										->where('activity_id', $activityId)
										->get()->last();
		
		return $activityOrder;
	}
}
