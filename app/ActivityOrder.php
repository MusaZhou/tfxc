<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityOrder extends Model
{
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];
	
	public function activity(){
		return $this->belongsTo('App\Activity');
	}
	
	public function paymentType(){
		return $this->belongsTo('App\PaymentType');
	}
	
	public function user(){
		return $this->belongsTo('App\User');
	}
	
	public function softDelete(){
		return $this->delete();
	}
}
