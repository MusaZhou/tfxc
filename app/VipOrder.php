<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VipOrder extends Model
{
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];
	
	public function vipPeriod(){
		return $this->hasOne('App\VipPeriod');
	}
	
	public function user(){
		return $this->belongsTo('App\User');
	}
	
	public function paymentType(){
		return $this->belongsTo('App\PaymentType');
	}
	
	public function softDelete(){
		$this->vipPeriod->softDelete();
		
		return $this->delete();
	}
}
