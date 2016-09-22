<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Log;
use App\User;

class UserCheck
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
//     	Log::info('session data:', $request->getSession()->all());
    	$wechatUser = session('wechat.oauth_user');
    	$openId = $wechatUser->getId();
    	 
    	$user = User::where('open_id', $openId)->first();
    	
    	if(empty($user)){
    		$user = new User();
    		$user->open_id = $openId;
    		$user->wechat_name = $wechatUser->getName();
    		$user->head_image_url = $wechatUser->getAvatar();
    		$user->save();
    	}
    	
    	session(['userId' => $user->id]);
    	
        return $next($request);
    }
}
