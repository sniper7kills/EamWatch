<?php

namespace App\Http\Resources\Stub;

use Illuminate\Http\Request;
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
        ];
    }
}
