<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VipPeriod extends Model
{
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];
	
	public function vipOrder(){
		return $this->belongsTo('App\VipOrder');
	}
	
	public function user(){
		return $this->belongsTo('App\User');
	}
	
	public function softDelete(){
		$this->delete();
	}
}
