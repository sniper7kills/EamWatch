<?php

namespace App\Http\Resources;

use App\Http\Resources\Stub\CommentResource as CommentResourceStub;
use App\Http\Resources\Stub\RecordingResource as RecordingResourceStub;
use App\Http\Resources\Stub\UserResource as UserResourceStub;

use App\Models\Message;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * @var Message
     */
    private $message = null;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->message = $resource;
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
            'id' => $this->message->id,
            'type' => $this->message->type,
            'sender' => $this->message->sender,
            'receiver' => $this->message->receiver,
            'time' => $this->message->time,
            'message' => $this->message->message,
            'comment_count' => $this->message->comments()->count(),
            'recording_count' => $this->message->recordings()->count(),
            'rating' => $this->message->ratings()->average('score'),
            'user' => UserResourceStub::make($this->message->userable),
            'comments' => CommentResourceStub::collection($this->message->comments()->paginate()),
            'recordings' => RecordingResourceStub::collection($this->message->recordings()->paginate()),
        ];
    }
}
