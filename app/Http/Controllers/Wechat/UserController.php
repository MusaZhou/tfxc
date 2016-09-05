<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function showNormalRegister(Request $request){
		return view('wechat.normal_register');
	}
	
	public function showVipRegister(Request $request){
		return view('wechat.vip_register');
	}
	
	public function personalInfo(Request $request){
		return view('wechat.personal_info');
	}
	
	public function activityHistory(Request $request){
		return view('wechat.activity_history');
	}
}
