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
        if(Auth::guest() && Auth::guard('api')->guest())
        {
            return Guest::current();
        }else{
            if(!Auth::guest())
                return Auth::user();
            else
                return Auth::guard('api')->user();
        }
    }
}
