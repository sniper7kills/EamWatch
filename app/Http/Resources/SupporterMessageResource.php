<?php

namespace App\Http\Resources;

use App\Models\SupporterMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupporterMessageResource extends JsonResource
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
            'name' => $this->message->name,
            'message' => $this->message->message,
        ];
    }

    /*
        public function with($request)
        {
            return [
                'links' => $this->links(MessageController::class),
                'can' => [
                    'update' => false,
                    'destroy' => false,
                ]
            ];
        }

        public static function meta()
        {
            return [
                'links' => self::collectionLinks(MessageController::class)
            ];
        }
    */
}
