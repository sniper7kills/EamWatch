<?php

namespace App\Http\Middleware;

use App\Models\Guest;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

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
