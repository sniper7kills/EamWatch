<?php

namespace App\Http\Resources\Stub;

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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
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
