<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Activity;

class UserController extends Controller
{
    public function personalCenter(Request $request){
    	$user = User::find($request->session()->get('userId'));
    	
    	$activityList = Activity::whereRaw('end_time > now()')->get();
    	
    	$activityOrderList = $user->activityOrders;
		$myActivityList = collect();
		
		foreach($activityOrderList as $activityOrder){
			$myActivityList->push($activityOrder->activity);
		}
		
		return view('user.personal_center', [
											'user' => $user,
											'activityList' => $activityList,
											'myActivityList' => $myActivityList,
											]);
	}
}
