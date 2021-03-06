<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Log;

class RegisteredUserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	$user = User::find($request->session()->get('userId'));
    	Log::info('user status:'.$user->status);
    	if($user->status == 0){
    		return redirect('/wechat/show_normal_register');
    	}
    	
        return $next($request);
    }
}
