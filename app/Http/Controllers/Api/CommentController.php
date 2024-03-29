<?php

namespace App\Http\Controllers\Api;

use App\Concerns\GetCurrentUserOrGuest;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentIndexRequest;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Message;
use App\Models\Recording;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommentController extends Controller
{
    use GetCurrentUserOrGuest;

    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CommentIndexRequest $request): AnonymousResourceCollection
    {
        $request = $request->validated();
        $commentable = null;
        if (array_key_exists('message_id', $request)) {
            $commentable = Message::find($request['message_id']);
        } elseif (array_key_exists('recording_id', $request)) {
            $commentable = Recording::find($request['recording_id']);
        }

        if (! array_key_exists('paginate', $request)) {
            $request['paginate'] = 15;
        }

        $messages = $commentable->comments()->orderBy('created_at', 'DESC')->paginate($request['paginate']);

        return CommentResource::collection($messages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentStoreRequest $request): CommentResource
    {
        $request = $request->validated();
        $comment = new Comment($request);

        $comment->user = $this->currentUserOrGuest();

        if (array_key_exists('message_id', $request)) {
            $message = Message::find($request['message_id']);
            $message->comments()->save($comment);
        } elseif (array_key_exists('recording_id', $request)) {
            $recording = Recording::find($request['recording_id']);
            $recording->comments()->save($comment);
        }

        return CommentResource::make($comment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment): CommentResource
    {
        return CommentResource::make($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return void
     */
    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @throws \Exception
     */
    public function destroy(Comment $comment): JsonResponse
    {
        $comment->delete();

        return response()->json()->setStatusCode(204);
    }
}
