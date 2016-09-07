<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function personalCenter(Request $request){
    	$user = User::find($request->session()->get('userId'));
		return view('user.personal_center', ['user' => $user]);
	}
}
