<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;
use App\Policies\Concerns\BanCheck;
use App\Policies\Concerns\UserOwnsResource;
use Exception;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class MessagePolicy
{
    use HandlesAuthorization, BanCheck, UserOwnsResource;

    /**
     * Determine whether the user can view any messages.
     */
    public function viewAny(?User $user): Response
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can view the message.
     */
    public function view(?User $user, Message $message): Response
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can create messages.
     */
    public function create(?User $user): Response
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can update the message.
     */
    public function update(?User $user, Message $message): Response
    {
        if (is_null($user) && !Auth::guard('api')->guest()) {
            $user = Auth::guard('api')->user();
        }

        if (!is_null($user) && $user->can('update messages')) {
            return Response::allow();
        }
        try {
            if (!is_null($user) && $user->hasPermissionTo('update messages', 'web')) {
                return Response::allow();
            }
        } catch (\Exception) {
            //print("Exception");
        }

        if (!$this->userOwnsResource($user, $message)) {
            return Response::deny('You did not create this message');
        }

        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can delete the message.
     */
    public function delete(User $user, Message $message): Response
    {
        if ($user->can('delete messages')) {
            return Response::allow();
        }
        try {
            if ($user->hasPermissionTo('delete messages', 'web')) {
                return Response::allow();
            }
        } catch (\Exception) {
            // print("Exception");
        }

        return Response::deny('No Permission to delete messages');
    }

    /**
     * Determine whether the user can restore the message.
     */
    public function restore(User $user, Message $message): Response
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can permanently delete the message.
     */
    public function forceDelete(User $user, Message $message): Response
    {
        return $this->checkBan($user);
    }
}
