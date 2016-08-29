<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index(Request $request){
		$userList = User::all();
		
		return view('admin.user_management', ['userList' => $userList]);
	}
	
	public function addUser(Request $request){
		$phone = $request->phone;
		$job = $request->job;
		$organization = $request->organization;
		$location = $request->location;
		$email = $request->email;
		$gender = $request->gender;
		$name = $request->name;
		$note = $request->note;
		
		$user = new User();
		$user->phone = $phone;
		$user->job = $job;
		$user->organization = $organization;
		$user->location = $location;
		$user->email = $email;
		$user->gender = $gender;
		$user->name = $name;
		$user->note = $note;
		
		$user->save();
		
		return redirect('/admin/user_management');
	}
	
	public function getUserInfoById(Request $request){
		$userId = $request->userId;
		
		$user = User::find($userId);
		
		$result = collect();
		
		$result->put('status', 1);
		$result->put('data', $user);
		
		return $result->toJson();
	}
	
	public function editUser(Request $request){
		$userId = $request->userId;
		$phone = $request->phone;
		$job = $request->job;
		$organization = $request->organization;
		$location = $request->location;
		$email = $request->email;
		$gender = $request->gender;
		$name = $request->name;
		$note = $request->note;
		
		$user = User::find($userId);
		$user->phone = $phone;
		$user->job = $job;
		$user->organization = $organization;
		$user->location = $location;
		$user->email = $email;
		$user->gender = $gender;
		$user->name = $name;
		$user->note = $note;
		
		$user->save();
		
		return redirect('/admin/user_management');
	}
}
