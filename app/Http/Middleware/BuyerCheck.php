<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Log;
use App\Buyer;

class BuyerCheck
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
    	 
    	$buyer = Buyer::where('open_id', $openId)->first();
    	
    	if(empty($buyer)){
    		$buyer = new Buyer();
    		$buyer->open_id = $openId;
    		$buyer->nick_name = $wechatUser->name;
    		$buyer->save();
    	}
    	
    	session(['buyerId' => $buyer->id]);
    	
        return $next($request);
    }
}
