<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];
	
	public function activityOrders(){
		return $this->hasMany('App\ActivityOrder');
	}
	
	public function softDelete(){
		foreach($this->activityOrders as $activityOrder){
			$activityOrder->softDelete();
		}
		
		$this->delete();
	}
}
