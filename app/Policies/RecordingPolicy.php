<?php

namespace App\Policies;

use App\Models\Recording;
use App\Models\User;
use App\Policies\Concerns\BanCheck;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RecordingPolicy
{
    use HandlesAuthorization, BanCheck;

    /**
     * Determine whether the user can view any recordings.
     */
    public function viewAny(?User $user): Response
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can view the recording.
     */
    public function view(?User $user, Recording $recording): Response
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can create recordings.
     */
    public function create(?User $user): Response
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can update the recording.
     */
    public function update(?User $user, Recording $recording): Response
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can delete the recording.
     */
    public function delete(User $user, Recording $recording): bool
    {
        if ($user->can('delete recordings')) {
            return true;
        }

        try {
            if ($user->hasPermissionTo('delete recordings', 'web')) {
                return true;
            }
        } catch (\Exception) {
            //print("Exception");
        }

        return false;
    }

    /**
     * Determine whether the user can restore the recording.
     */
    public function restore(User $user, Recording $recording): Response
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the recording.
     */
    public function forceDelete(User $user, Recording $recording): Response
    {
        //
    }
}
