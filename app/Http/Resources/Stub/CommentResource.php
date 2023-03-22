<?php

namespace App\Http\Resources\Stub;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
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
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->comment->id,
            'comment' => $this->comment->message,
            'time' => $this->comment->time,
            'user' => UserResource::make($this->comment->userable),
            'message' => MessageResource::make($this->comment->messages()->first()),
        ];
    }
}
