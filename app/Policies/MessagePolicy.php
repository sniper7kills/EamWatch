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
     *
     * @param  User  $user
     * @return mixed
     */
    public function viewAny(?User $user): bool
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can view the message.
     *
     * @param  User  $user
     * @param  \App\Models\Message  $message
     * @return mixed
     */
    public function view(?User $user, Message $message): bool
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can create messages.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(?User $user): bool
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can update the message.
     *
     * @param  User  $user
     * @param  \App\Models\Message  $message
     * @return mixed
     */
    public function update(?User $user, Message $message): Response
    {
        if (is_null($user) && ! Auth::guard('api')->guest()) {
            $user = Auth::guard('api')->user();
        }

        if (! is_null($user) && $user->can('update messages')) {
            return Response::allow();
        }
        try {
            if (! is_null($user) && $user->hasPermissionTo('update messages', 'web')) {
                return Response::allow();
            }
        } catch (\Exception) {
            //print("Exception");
        }

        if (! $this->userOwnsResource($user, $message)) {
            return Response::deny('You did not create this message');
        }

        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can delete the message.
     *
     * @param  User  $user
     * @param  \App\Models\Message  $message
     * @return mixed
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
            echo 'Exception';
        }

        return Response::deny('No Permission to delete messages');
    }

    /**
     * Determine whether the user can restore the message.
     *
     * @param  User  $user
     * @param  \App\Models\Message  $message
     * @return mixed
     */
    public function restore(User $user, Message $message): bool
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can permanently delete the message.
     *
     * @param  User  $user
     * @param  \App\Models\Message  $message
     * @return mixed
     */
    public function forceDelete(User $user, Message $message): bool
    {
        return $this->checkBan($user);
    }
}
