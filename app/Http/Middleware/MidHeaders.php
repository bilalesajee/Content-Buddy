<?php

namespace App\Http\Middleware;

use Closure;

class MidHeaders
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
        $response = $next($request);
        $response->headers->set("Content-Type: application/json:", true);
        $response->headers->set('Access-Control-Allow-Credentials', true);
        $response->headers->set("Access-Control-Allow-Origin", '*');
        $response->headers->set("Access-Control-Allow-Headers" ,"x-prototype-version,X-Requested-With");
        $response->headers->set("Access-Control-Request-Method", "GET,POST");
        return $response;
    }
}
