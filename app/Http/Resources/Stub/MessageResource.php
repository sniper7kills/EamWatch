<?php

namespace App\Http\Resources\Stub;

use Illuminate\Http\Request;
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
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->message->id,
            'type' => $this->message->type,
            'time' => $this->message->time,
        ];
    }
}
