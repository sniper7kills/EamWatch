<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Guest;
use App\Models\User;
use App\Policies\Concerns\BanCheck;
use App\Policies\Concerns\UserOwnsResource;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class CommentPolicy
{
    use HandlesAuthorization, BanCheck, UserOwnsResource;

    /**
     * Determine whether the user can view any comments.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can view the comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return mixed
     */
    public function view(?User $user, Comment $comment)
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can create comments.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(?User $user)
    {
        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can update the comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return mixed
     */
    public function update(?User $user, Comment $comment)
    {
        if (is_null($user) && !Auth::guard('api')->guest()) {
            $user = Auth::guard('api')->user();
        }

        if (!is_null($user) && $user->can('update comments', 'web')) {
            return Response::allow();
        }

        if (!$this->userOwnsResource($user, $comment)) {
            return Response::deny('You did not create this comment');
        }

        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return mixed
     */
    public function delete(?User $user, Comment $comment)
    {
        if (is_null($user) && !Auth::guard('api')->guest()) {
            $user = Auth::guard('api')->user();
        }

        if (!is_null($user) && $user->hasPermissionTo('delete comments', 'web')) {
            return Response::allow();
        }

        if (!$this->userOwnsResource($user, $comment)) {
            return Response::deny('You did not create this comment');
        }

        return $this->checkBan($user);
    }

    /**
     * Determine whether the user can restore the comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return mixed
     */
    public function restore(User $user, Comment $comment)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return mixed
     */
    public function forceDelete(User $user, Comment $comment)
    {
        //
    }
}
