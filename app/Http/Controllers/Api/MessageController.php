<?php

namespace App\Http\Controllers\Api;

use App\Concerns\GetCurrentUserOrGuest;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageStoreRequest;
use App\Http\Requests\MessageUpdateRequest;
use App\Http\Resources\MessageResource;
use App\Models\Guest;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    use GetCurrentUserOrGuest;

    public function __construct()
    {
        $this->middleware('auth:api')->only('destroy');
        $this->authorizeResource(Message::class, 'message');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $messages = Message::where('visible',true)->orderBy('broadcast_ts','DESC')->orderBy('created_at','DESC')->paginate($request->get('paginate',15));
        return MessageResource::collection($messages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MessageStoreRequest  $request
     * @return MessageResource
     */
    public function store(MessageStoreRequest $request)
    {
        $request = $request->validated();
        $message = new Message($request);

        $message->user = $this->currentUserOrGuest();

        $message->save();

        return MessageResource::make($message);
    }

    /**
     * Display the specified resource.
     *
     * @param Message $message
     * @return MessageResource
     */
    public function show(Message $message)
    {
        return MessageResource::make($message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MessageUpdateRequest  $request
     * @param  Message  $message
     * @return MessageResource
     */
    public function update(MessageUpdateRequest $request, Message $message)
    {
        $request = $request->validated();
        $message->update($request);

        return MessageResource::make($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Message $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return response()->json()->setStatusCode(204);
    }
}
