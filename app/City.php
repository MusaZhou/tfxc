<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];
	
	public function activities(){
		return $this->hasMany('App\Activity');
	}
	
	public function province(){
		return $this->belongsTo('App\Province');
	}
}
