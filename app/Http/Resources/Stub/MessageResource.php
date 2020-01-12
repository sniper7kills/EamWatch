<?php

namespace App\Http\Resources\Stub;

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
            'time' => $this->message->time,
        ];
    }
}
