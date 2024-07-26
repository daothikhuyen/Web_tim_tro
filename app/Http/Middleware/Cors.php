<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $domains = ['https://vapi.vnappmob.com'];

        if(isset($request->server()['HTTP_ORIGIN'])){
            $origin = $request->server()['HTTP_ORIGIN'];

            if(in_array($origin,$domains)){
                header("Access-Controler-Allow-Origin: ".$origin);
                header("Access-Controler-Allow-Origin: Origin, Content-Type, Authorization");
            }

        }
        return $next($request);
    }
}
