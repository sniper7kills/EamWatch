<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Guest;
use App\Models\User;
use App\Policies\Concerns\BanCheck;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    use HandlesAuthorization, BanCheck;

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
        if(!is_null($user) && $user->can('update comments'))
        {
            return Response::allow();
        }

        //Ensure the creator of the message is the same person looking to edit the message.
        if(!is_null($user)){
            if($user->id != $comment->userable->id || $user->getMorphClass() != $comment->userable->getMorphClass()){
                return Response::deny('You did not create this comment');
            }
        } else {
            if(Guest::current()->id != $comment->userable->id || $comment->userable->getMorphClass() != Guest::class){
                return Response::deny('You did not create this comment');
            }
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
        if(!is_null($user) && $user->hasPermissionTo('delete comments'))
            return Response::allow();

        //Ensure the creator of the message is the same person looking to edit the message.
        if(!is_null($user)){
            if($user->id != $comment->userable->id || $user->getMorphClass() != $comment->userable->getMorphClass()){
                return Response::deny('You did not create this comment');
            }
        } else {
            if(Guest::current()->id != $comment->userable->id || $comment->userable->getMorphClass() != Guest::class){
                return Response::deny('You did not create this comment');
            }
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
