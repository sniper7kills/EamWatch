<?php

namespace App\Http\Resources;

use App\Models\Guest;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\ResourceLinks\HasLinks;

class UserResource extends JsonResource
{
    use HasLinks;

    /**
     * @var User | Guest
     */
    private $user = null;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->user = $resource;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
