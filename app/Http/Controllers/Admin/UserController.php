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
}
