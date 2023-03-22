<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Concerns\GetCurrentUserOrGuest;
use App\Http\Resources\Stub\MessageResource;
use App\Models\Comment;
use App\Models\Guest;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    use GetCurrentUserOrGuest;

    /**
     * @var Comment
     */
    private $comment = null;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->comment = $resource;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $canUpdate = false;

        $user = $this->currentUserOrGuest();

        if ($user->getMorphClass() === Guest::class) {
            if ($this->comment->userable == $user) {
                $canUpdate = true;
            }
        } else {
            $canUpdate = $user->can('update', $this->comment);
        }

        $canDelete = false;
        if ($user->getMorphClass() === Guest::class) {
            if ($this->comment->userable == $user) {
                $canDelete = true;
            }
        } else {
            $canDelete = $user->can('delete', $this->comment);
        }

        return [
            'id' => $this->comment->id,
            'comment' => $this->comment->message,
            'user' => \App\Http\Resources\Stub\UserResource::make($this->comment->userable),
            'message' => MessageResource::make($this->comment->messages()->first()),
            'permissions' => [
                'update' => $canUpdate,
                'delete' => $canDelete,
            ],
        ];
    }
}
