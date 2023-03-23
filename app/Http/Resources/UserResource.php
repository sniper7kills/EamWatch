<?php

namespace App\Http\Resources;

use App\Concerns\GetCurrentUserOrGuest;
use App\Http\Controllers\Api\UserController;
use App\Models\Guest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    use GetCurrentUserOrGuest;

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
     */
    public function toArray(Request $request): array
    {
        $user = $this->currentUserOrGuest();

        /**
         * Edit.
         */
        if ($user->getMorphClass() === Guest::class) {
            $canEdit = false;
        } else {
            /* @var $user \App\Models\User */
            if ($this->resource->getMorphClass() == User::class) {
                $canEdit = $user->hasPermissionTo('edit users', 'web');
            } else {
                $canEdit = false;
            }
        }
        /**
         * Ban.
         */
        if ($user->getMorphClass() === Guest::class) {
            $canBan = false;
        } else {
            /* @var $user \App\Models\User */
            if ($this->resource->getMorphClass() == User::class) {
                $canBan = $user->hasPermissionTo('ban users', 'web');
            } else {
                $canBan = $user->hasPermissionTo('ban guests', 'web');
            }
        }
        /**
         * Unban.
         */
        if ($user->getMorphClass() === Guest::class) {
            $canUnban = false;
        } else {
            /* @var $user \App\Models\User */
            if ($this->resource->getMorphClass() == User::class) {
                $canUnban = $user->hasPermissionTo('unban users', 'web');
            } else {
                $canUnban = $user->hasPermissionTo('unban guests', 'web');
            }
        }

        $email = 'None';
        if ($this->resource->getMorphClass() == User::class) {
            $email = '[REDACTED]';
            if (
                $user->getMorphClass() == User::class &&
                ($user->id == $this->resource->id
                    || $user->hasPermissionTo('edit users', 'web'))
            ) {
                $email = $this->resource->email;
            }
        }

        return [
            $this->mergeWhen($this->resource->getMorphClass() == User::class, [
                'name' => $this->resource->name,
                'id' => $this->resource->id,
                'type' => 'user',
                'role' => $this->resource->displayRole(),
            ]),
            $this->mergeWhen($this->resource->getMorphClass() == Guest::class, [
                'name' => $this->resource->id,
                'id' => $this->resource->id,
                'type' => 'guest',
                'role' => 'Guest',
            ]),
            'email' => $email,
            'banned' => $this->resource->banned,
            'submissions' => [
                'messages' => $this->resource->messages()->count(),
                'recordings' => $this->resource->recordings()->count(),
                'comments' => $this->resource->comments()->count(),
                'ratings' => $this->resource->ratings()->count(),
            ],
            'permissions' => [
                'edit' => $canEdit,
                'ban' => $canBan,
                'unban' => $canUnban,
                'self' => $this->resource->id == $user->id,
            ],
            'links' => [
                'show' => action([UserController::class, 'show'], $this),
                'update' => action([UserController::class, 'update'], $this),
            ],
        ];
    }

    public static function meta()
    {
        return [
            'links' => [
                'index' => action([UserController::class, 'index']),
                'create' => action([UserController::class, 'create']),
                'store' => action([UserController::class, 'store']),
            ],
        ];
    }
}
