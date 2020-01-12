<?php

namespace App\Http\Resources;

use App\Models\Recording;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\ResourceLinks\HasLinks;

class RecordingResource extends JsonResource
{
    use HasLinks;

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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->recording->id,
            'link' => $this->recording->link,
            'frequency' => $this->recording->frequency,
            'receiver' => $this->recording->receiver,
            'time' => $this->recording->time,
            'message' => \App\Http\Resources\Stub\MessageResource::make($this->recording->message),
            'user' => \App\Http\Resources\Stub\UserResource::make($this->recording->userable),
        ];
    }
}
