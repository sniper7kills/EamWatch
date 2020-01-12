<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Guest;
use App\Models\Message;
use App\Models\Recording;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Comment::class, 'comment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return CommentResource
     */
    public function store(CommentStoreRequest $request)
    {
        $request = $request->validated();
        $comment = new Comment($request);

        if(Auth::guest())
            $user = Guest::current();
        else
            $user = Auth::user();

        $comment->user = $user;

        if(key_exists('message_id', $request))
        {
            $message = Message::find($request['message_id']);
            $message->comments()->save($comment);
        }elseif(key_exists('recording_id', $request)) {
            $recording = Recording::find($request['recording_id']);
            $recording->comments()->save($comment);
        }

        return CommentResource::make($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Comment $comment
     * @return void
     */
    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json()->setStatusCode(204);
    }
}
