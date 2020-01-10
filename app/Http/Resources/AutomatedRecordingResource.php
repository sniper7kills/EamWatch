<?php

namespace App\Http\Resources;

use App\Models\Recording;
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->recording->id,
            'time' => $this->recording->time,
            'frequency' => $this->recording->frequency,
            'receiver' => $this->recording->receiver,
            'link' => $this->recording->link,
            'user' => \App\Http\Resources\Stub\UserResource::make($this->recording->userable),
        ];
    }
}
