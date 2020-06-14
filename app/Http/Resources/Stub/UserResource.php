<?php

namespace App\Http\Resources\Stub;

use App\Models\Guest;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            $this->mergeWhen($this->resource->getMorphClass() == User::class,[
                'name' => $this->resource->name,
                'id' => $this->resource->id,
                'type' => 'user'
            ]),
            $this->mergeWhen($this->resource->getMorphClass() == Guest::class,[
                'name' => $this->resource->id,
                'id' => $this->resource->id,
                'type' => 'guest'
            ]),
        ];
    }
}
