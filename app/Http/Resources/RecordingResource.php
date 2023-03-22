<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\RecordingController;
use App\Models\Recording;
use Illuminate\Http\Resources\Json\JsonResource;

class RecordingResource extends JsonResource
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
            'link' => $this->recording->link,
            'frequency' => $this->recording->frequency,
            'receiver' => $this->recording->receiver,
            'time' => $this->recording->time,
            'message' => \App\Http\Resources\Stub\MessageResource::make($this->recording->message),
            'user' => \App\Http\Resources\Stub\UserResource::make($this->recording->userable),
            'links' => [
                'show' => action([RecordingController::class, 'show'], $this),
                'update' => action([RecordingController::class, 'update'], $this),
                'delete' => action([RecordingController::class, 'destroy'], $this),
            ],
        ];
    }

    public static function meta()
    {
        return [
            'links' => [
                'index' => action([RecordingController::class, 'index']),
                'create' => action([RecordingController::class, 'create']),
                'store' => action([RecordingController::class, 'store']),
            ],
        ];
    }
}
