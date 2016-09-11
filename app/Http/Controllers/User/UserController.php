<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Activity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
	
	public function updateProfile(Request $request){
		$user = User::find($request->session()->get('userId'));
		
		$name = $request->name;
		$phone = $request->phone;
		$email = $request->email;
		$job = $request->job;
		$organization = $request->organization;
		$location = $request->location;
		$gender = $request->gender;
		
		$user->name = $name;
		$user->phone = $phone;
		$user->email = $email;
		$user->job = $job;
		$user->organization = $organization;
		$user->location = $location;
		$user->gender = $gender;
		
		$user->save();
		
		return redirect('/user/personal_center');
	}
	
	public function updatePassword(Request $request){
		$user = User::find($request->session()->get('userId'));
		$password = $request->newPassword;
		
		$user->password = bcrypt($password);
		$user->save();
		
		return redirect('/user/personal_center');
	}
	
	public function checkPassword(Request $request){
		$password = $request->password;
		$user = User::find($request->session()->get('userId'));
		
		if(Hash::check($password, $user->password)){
			return ['status' => 1];
		}else{
			return ['status' => 2];
		}
	}
	
	public function uploadHeadImage(Request $request){
		$user = User::find($request->session()->get('userId'));
		
		$file = $request->file('headImage');
		$extension = $file->getClientOriginalExtension();
		$imageUrl = '/user/head_image/'.$user->id.'-'.rand(111, 999).'.'.$extension;
		
		Storage::put($imageUrl, file_get_contents($file->getRealPath()));
		
		$user->head_image_url = $imageUrl;
		$user->save();
		
		return 1;
	}
}
