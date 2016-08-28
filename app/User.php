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
		$vipPeriod = $this->vipPeriods()->whereRaw('start_date <= now() AND end_date >= now()')->get();
		
		return !$vipPeriod->isEmpty();
	}
}
