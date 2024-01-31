<?php

namespace App\Policies;

use App\Models\User;
use App\Policies\Concerns\BanCheck;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use BanCheck, HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, User $model): Response
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): Response
    {
        $response = $this->checkBan($user);
        if ($response->denied()) {
            return $response;
        }

        if ($user->id === $model->id) {
            return Response::allow();
        }

        if ($user->hasPermissionTo('edit users', 'web')) {
            return Response::allow();
        }
        if ($user->hasPermissionTo('ban users', 'web')) {
            return Response::allow();
        }
        if ($user->hasPermissionTo('unban users', 'web')) {
            return Response::allow();
        }

        return Response::deny('No Permission to Edit User');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): Response
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): Response
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can upload files.
     *
     * @return mixed
     */
    public function uploadFiles(?User $user)
    {
        return $this->checkBan($user);
    }
}
