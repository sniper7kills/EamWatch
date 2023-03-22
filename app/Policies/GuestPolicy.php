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
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the guest.
     */
    public function view(?User $user, Guest $guest): bool
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can create guests.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the guest.
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
     */
    public function delete(User $user, Guest $guest): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the guest.
     */
    public function restore(User $user, Guest $guest): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the guest.
     */
    public function forceDelete(User $user, Guest $guest): bool
    {
        //
    }
}
