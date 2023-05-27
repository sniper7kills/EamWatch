<?php

namespace App\Http\Resources;

use App\Concerns\GetCurrentUserOrGuest;
use App\Http\Controllers\Api\MessageController;
use App\Http\Resources\Stub\CommentResource as CommentResourceStub;
use App\Http\Resources\Stub\RecordingResource as RecordingResourceStub;
use App\Http\Resources\Stub\UserResource as UserResourceStub;
use App\Models\Guest;
use App\Models\Message;
use App\Models\Recording;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    use GetCurrentUserOrGuest;

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
     */
    public function toArray(Request $request): array
    {
        $canUpdate = false;

        $user = $this->currentUserOrGuest();

        if ($user->getMorphClass() === Guest::class) {
            if ($this->message->userable == $user) {
                $canUpdate = true;
            }
        } else {
            $canUpdate = $user->can('update', $this->message);
        }

        $canDelete = false;

        if ($user->getMorphClass() === User::class) {
            $canDelete = $user->can('delete', $this->message);
        }

        $repeats = 0;

        if ($this->message->type == "ALLSTATIONS") {
            $repeats = Message::where('type', $this->message->type)->where('message', $this->message->message)->where('broadcast_ts', '<', $this->message->time)->count();
        }

        return [
            'id' => $this->message->id,
            'type' => $this->message->type,
            'sender' => $this->message->sender,
            'receiver' => $this->message->receiver ? $this->message->receiver : '',
            'time' => $this->message->time,
            'message' => $this->message->message,
            'comment_count' => $this->message->comments()->count(),
            'recording_count' => $this->message->recordings()->count(),
            'rating' => $this->message->ratings()->average('score'),
            'user' => UserResourceStub::make($this->message->userable),
            'comments' => CommentResourceStub::collection($this->message->lastFiveComments),
            'recordings' => RecordingResourceStub::collection($this->message->recordings()->paginate()),
            'automated_recordings' => RecordingResourceStub::collection(Recording::where('automated', true)->whereBetween('broadcasted_at', [$this->message->broadcast_ts->subMinutes(2), $this->message->broadcast_ts->addMinutes(2)])->paginate()),
            'permissions' => [
                'update' => $canUpdate,
                'delete' => $canDelete,
            ],
            'repeats' => $repeats
        ];
    }

    /*
        public function with($request)
        {
            return [
                'links' => $this->links(MessageController::class),
                'can' => [
                    'update' => false,
                    'destroy' => false,
                ]
            ];
        }

        public static function meta()
        {
            return [
                'links' => self::collectionLinks(MessageController::class)
            ];
        }
    */
}
