<?php

namespace App\Policies\Concerns;

use App\Models\Guest;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

trait BanCheck
{
    private function checkBan(?User $user)
    {
        if (is_null($user) && ! Auth::guard('api')->guest()) {
            $user = Auth::guard('api')->user();
        }

        if (! is_null($user) && $user->banned) {
            return Response::deny('You are banned.');
        } elseif (is_null($user) && Guest::current()->banned) {
            return Response::deny('You are banned.');
        }

        return Response::allow();
    }
}
