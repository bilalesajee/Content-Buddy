<?php

namespace App\Http\Middleware;
use App\User;
use Illuminate\Support\Facades\Auth;

use Closure;

class AuthenticateUser
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
        $is_blocked  = User::where('id',Auth::id())
                ->where(function($q){
                    $q->where('is_blocked', 1);
                    $q->orwhere('is_approved_by_admin', 0);
                })->first(); 
       if($is_blocked != null){ 
            return redirect('logout');
        }
        return $next($request);
    }
}
