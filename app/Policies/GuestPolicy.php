<?php

namespace App\Policies;

use App\Models\Guest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GuestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any guests.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
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
    public function view(User $user, Guest $guest)
    {
        //
    }

    /**
     * Determine whether the user can create guests.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
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
    public function update(User $user, Guest $guest)
    {
        //
    }

    /**
     * Determine whether the user can delete the guest.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Guest  $guest
     * @return mixed
     */
    public function delete(User $user, Guest $guest)
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
    public function restore(User $user, Guest $guest)
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
    public function forceDelete(User $user, Guest $guest)
    {
        //
    }
}
