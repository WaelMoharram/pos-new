<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SalesNotAllow
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (\Auth::user()->type != 'sales'){
            return $next($request);
        }else{
            return redirect()->back();
        }

    }
}
