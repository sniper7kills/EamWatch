<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\Guest;
use Closure;
use Illuminate\Support\Facades\Auth;

class BannedMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guest()) {
            if (Guest::current()->banned) {
                return response()->redirectTo('/banned');
            }
        } else {
            if (Auth::user()->banned) {
                return response()->redirectTo('/banned');
            }
        }

        return $next($request);
    }
}
