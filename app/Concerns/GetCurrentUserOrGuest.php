<?php

namespace App\Concerns;

use App\Models\Guest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait GetCurrentUserOrGuest
{
    /**
     * @return User | Guest
     */
    protected function currentUserOrGuest()
    {
        $guard = 'web';
        if(Auth::user() == null && Auth::guard('api')->user() != null)
            $guard = 'api';

        if(Auth::guard($guard)->guest())
            $user = Guest::current();
        else
            $user = Auth::guard($guard)->user();

        return $user;
    }
}
