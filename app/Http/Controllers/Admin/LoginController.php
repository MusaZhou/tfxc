<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Admin;
use Hash;
use Log;
use App\Http\Controllers\Controller;
use App\User;

class LoginController extends Controller
{
	// login validation
	public function login(Request $request){
		$name = $request->name;
		$password = $request->password;
		$remember = $request->remember;
	
		$user = Admin::where('name', $name)->first();
		$status = null;
		$error = null;

		if(!isset($user)){
			$status = -1;
			$error = '用户名不存在';
		}else{
			if(Hash::check($password, $user->password)){

				$withCookie = false;
				$cookie;
				if(!empty($remember) && $remember == 1){
					$withCookie = true;
					$cookie = cookie('user', $user->id);
				}
	
				$request->session()->put('userId', $user->id);

				$redirector = redirect('/admin/user_management');
					
				if($withCookie){
					return $redirector->withCookie($cookie);
				}else{
					return $redirector;
				}
			}else{

				$status = -2;
				$error = '密码不正确';
			}
		}

		return view('admin.login', ['status' => $status, 'error' => $error]);
	}
	
	public function index(Request $request){
		$previous_url_type = $request->session()->get('previous_url');
		if($previous_url_type == 1){
			$request->session()->forget('previous_url');
			return view('admin.login');
		}else{
			if($request->hasCookie('user')){
				$user = User::find($request->cookie('user'));
				$request->session()->put('userId', $user->id);
				return redirect('admin/user_management');
			}else{
				return view('admin.login');
			}
		}
	}
	
	public function logout(Request $request){
		$request->session()->forget('userId');
		$request->session()->put('previous_url_type', 1);
		return view('admin.login');
	}
}
