<?php

namespace App\Http\Resources;

use App\Http\Controllers\Api\AutomatedRecordingController;
use App\Models\Message;
use App\Models\Recording;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AutomatedRecordingResource extends JsonResource
{
    /**
     * @var Recording
     */
    private $recording = null;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->recording = $resource;
    }

    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->recording->id,
            'time' => $this->recording->time,
            'frequency' => $this->recording->frequency,
            'receiver' => $this->recording->receiver,
            'link' => $this->recording->link,
            'user' => \App\Http\Resources\Stub\UserResource::make($this->recording->userable),
            'message_count' => Message::whereBetween('broadcast_ts', [$this->recording->broadcasted_at->subMinutes(2), $this->recording->broadcasted_at->addMinutes(2)])->count(),
            'links' => [
                'update' => action([AutomatedRecordingController::class, 'update'], $this),
                'delete' => action([AutomatedRecordingController::class, 'destroy'], $this),
            ],
        ];
    }

    public static function meta()
    {
        return [
            'links' => [
                'index' => action([AutomatedRecordingController::class, 'index']),
                'create' => action([AutomatedRecordingController::class, 'create']),
                'store' => action([AutomatedRecordingController::class, 'store']),
            ],
        ];
    }
}
