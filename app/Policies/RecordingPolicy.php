<?php

namespace App\Policies;

use App\Models\Recording;
use App\Models\User;
use App\Policies\Concerns\BanCheck;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecordingPolicy
{
    use HandlesAuthorization, BanCheck;

    /**
     * Determine whether the user can view any recordings.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(?User $user): bool
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can view the recording.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Recording  $recording
     * @return mixed
     */
    public function view(?User $user, Recording $recording): bool
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can create recordings.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(?User $user): bool
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can update the recording.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Recording  $recording
     * @return mixed
     */
    public function update(?User $user, Recording $recording): bool
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can delete the recording.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Recording  $recording
     * @return mixed
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
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Recording  $recording
     * @return mixed
     */
    public function restore(User $user, Recording $recording): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the recording.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Recording  $recording
     * @return mixed
     */
    public function forceDelete(User $user, Recording $recording): bool
    {
        //
    }
}
