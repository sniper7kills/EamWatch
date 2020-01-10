<?php

namespace App\Http\Resources\Stub;

use App\Models\Guest;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
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
        return [
            $this->mergeWhen($this->user->getMorphClass() == User::class,[
                'name' => $this->user->name,
            ]),
            $this->mergeWhen($this->user->getMorphClass() == Guest::class,[
                'name' => $this->user->id
            ])
        ];
    }
}
