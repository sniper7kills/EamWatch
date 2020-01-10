<?php

namespace App\Http\Controllers\Api;

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
    public function __construct()
    {
        $this->authorizeResource(Message::class, 'message');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $messages = Message::where('visible',true)->orderBy('broadcast_ts','DESC')->paginate();
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

        if(Auth::guest())
            $user = Guest::current();
        else
            $user = Auth::user();

        $message->user = $user;

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
     * @return \Illuminate\Http\Response
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
