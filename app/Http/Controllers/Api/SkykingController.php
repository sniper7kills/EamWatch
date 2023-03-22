<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;

class SkykingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Message::class, 'message');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $messages = Message::where('type', 'SKYKING')->where('visible', true)->orderBy('broadcast_ts', 'DESC')->paginate($request->get('paginate', 15));

        return MessageResource::collection($messages);
    }
}
