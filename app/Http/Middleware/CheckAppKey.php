<?php

namespace App\Http\Middleware;

use Closure;

class CheckAppKey
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
        if($headers['app_key'] == 'MdeDKSXifoYhQZYpEvh+Eol2PvuPWBuL7rVjaHRO7j0='){
        return $next($request);}
        else{
          return  sendError('You Are Not Authorize For App',404);
//         return Response::json(array('status'=>'error','errorMessage'=>'You Are Not Authorize For App'));   
        }
    }
}
