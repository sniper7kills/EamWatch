<?php

namespace App\Http\Resources\Stub;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AutomatedRecordingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
