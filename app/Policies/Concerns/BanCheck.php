<?php

namespace App\Policies\Concerns;

use App\Models\Guest;
use App\Models\User;
use Illuminate\Auth\Access\Response;

trait BanCheck
{
    private function checkBan(?User $user)
    {
        if(!is_null($user) && $user->banned){
            return Response::deny('You are banned.');
        } else if(is_null($user) && Guest::current()->banned) {
            return Response::deny('You are banned.');
        }
        return Response::allow();
    }
}
