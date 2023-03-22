<?php

namespace App\Policies;

use App\Models\Guest;
use App\Models\User;
use App\Policies\Concerns\BanCheck;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class GuestPolicy
{
    use HandlesAuthorization, BanCheck;

    /**
     * Determine whether the user can view any guests.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the guest.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Guest  $guest
     * @return mixed
     */
    public function view(?User $user, Guest $guest): bool
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can create guests.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the guest.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Guest  $guest
     * @return mixed
     */
    public function update(User $user, Guest $guest): Response
    {
        $response = $this->checkBan($user);
        if ($response->denied()) {
            return $response;
        }

        if ($user->hasAnyPermission(['ban guests', 'unban guests'])) {
            return Response::allow();
        }

        return Response::deny('No Permission to Edit Guest');
    }

    /**
     * Determine whether the user can delete the guest.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Guest  $guest
     * @return mixed
     */
    public function delete(User $user, Guest $guest): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the guest.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Guest  $guest
     * @return mixed
     */
    public function restore(User $user, Guest $guest): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the guest.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Guest  $guest
     * @return mixed
     */
    public function forceDelete(User $user, Guest $guest): bool
    {
        //
    }
}
