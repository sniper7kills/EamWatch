<?php

namespace App\Policies\Concerns;

use App\Models\Guest;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait UserOwnsResource
{
    private function userOwnsResource(?User $user, Model $resource)
    {
        if(is_null($user) && !Auth::guard('api')->guest())
            $user = Auth::guard('api')->user();

        //Ensure the creator of the message is the same person looking to edit the message.
        if(!is_null($user)){
            if($user->id != $resource->userable->id || $user->getMorphClass() != $resource->userable->getMorphClass()){
                return false;
            }
        } else {
            if(Guest::current()->id != $resource->userable->id || $resource->userable->getMorphClass() != Guest::class){
                return false;
            }
        }

        return true;
    }
}
