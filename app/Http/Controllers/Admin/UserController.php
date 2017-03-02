<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\PaymentType;
use App\Constant;
use DB;
use App\VipOrder;
use Log;

class UserController extends Controller
{
    public function index(Request $request){
		$userList = User::where('status', 1)->get();
// 		Log::info('user list:'.$userList);
		$vipUserList = $userList->filter(function($item, $key){
			return $item->isVip();	
		});
// 		Log::info('vip user list:'.$vipUserList);
		$normalUserList = $userList->diff($vipUserList);
// 		Log::info('normal user list:'.$normalUserList);
		$paymentTypeList = PaymentType::all();
		
		$vipStandardPrice = Constant::first()->vip_price;
		
		return view('admin.user_management', [
												'normalUserList' => $normalUserList, 
												'vipUserList' => $vipUserList,
												'paymentTypeList' => $paymentTypeList,
												'standardVipPrice' => $vipStandardPrice,
		]);
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
		$user->status = 1;
		$user->password = bcrypt('123456');
		
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
	
	public function updateVipStandardPrice(Request $request){
		$price = $request->price;
		
		DB::table('constants')->update(['vip_price' => $price]);
		
		return ['status' => 1];
	}
	
	public function updateUserVipPrice(Request $request){
		$userId = $request->userId;
		$price = $request->price;
		
		$vipOrder = new VipOrder();
		$vipOrder->user_id = $userId;
		$vipOrder->price = $price;
		$vipOrder->payment_type_id = 1;
		$vipOrder->status = 1;
		$vipOrder->save();
		
		return ['status' => 1];
	}
}
