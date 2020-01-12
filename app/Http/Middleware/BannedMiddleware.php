<?php

namespace App\Http\Middleware;

use App\Models\Guest;
use Closure;
use Illuminate\Support\Facades\Auth;

class BannedMiddleware
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
        if(Auth::guest()){
            if(Guest::current()->banned)
                return response()->redirectTo('/banned');
        }else{
            if(Auth::user()->banned)
                return response()->redirectTo('/banned');
        }
        return $next($request);
    }
}
