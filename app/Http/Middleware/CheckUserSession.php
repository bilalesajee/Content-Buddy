<?php

namespace App\Http\Middleware;

use Closure;
use App\UserSession;
use App\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserSession
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
       $headers = getallheaders();
//       dd($headers['session_token']);
        $checksession = UserSession::where('session_token',$headers['session_token'])->first();
//       dd($checksession);
        if($checksession){
            $user_id = $checksession->user_id;
            $user = User::where('id',$user_id)->first();
            if($user){
                Auth::login($user);
                return $next($request);}
            else{
                return Response::json(array('status'=>400,'errorMessage'=>'Session Expired','errorCode'=>400),400);   
            }
        }else{
            return Response::json(array('status'=>400,'errorMessage'=>'Session Expired','errorCode'=>400),400);
        }
    }
}
