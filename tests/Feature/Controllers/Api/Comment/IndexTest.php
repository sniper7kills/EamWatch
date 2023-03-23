<?php

namespace Tests\Feature\Controllers\Api\Comment;

use App\Models\Comment;
use App\Models\Message;
use App\Models\User;
use Tests\TestCase;

class IndexTest extends TestCase
{
    public function test_index_requires_message_or_recording_id(): void
    {
        $this->json('get', route('comments.index'))
            ->assertStatus(422);
    }

    public function test_index_requires_valid_message_id(): void
    {
        $this->json('get', route('comments.index'), [
            'message_id' => 1,
        ])
            ->assertStatus(422);
    }

    public function test_index_requires_valid_recording_id(): void
    {
        $this->json('get', route('comments.index'), [
            'message_id' => 1,
        ])
            ->assertStatus(422);
    }

    public function test_index_is_paginated(): void
    {
        $user = User::factory()->create();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();

        $comment = Comment::factory()->make();
        $comment->user = $user;
        $comment->message = $message;
        $message->comments()->save($comment);

        $comment2 = Comment::factory()->make();
        $comment2->user = $user;
        $message->comments()->save($comment2);

        $this->json('get', route('comments.index'), [
            'message_id' => $message->id,
        ])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => $comment->id,
                        'comment' => $comment->message,
                        'user' => [
                            'name' => $user->name,
                        ],
                        'permissions' => [
                            'update' => false,
                            'delete' => false,
                        ],
                    ],
                    [
                        'id' => $comment2->id,
                        'comment' => $comment2->message,
                        'user' => [
                            'name' => $user->name,
                        ],
                        'permissions' => [
                            'update' => false,
                            'delete' => false,
                        ],
                    ],
                ],
                'links' => [
                    'first' => route('comments.index').'?page=1',
                    'last' => route('comments.index').'?page=1',
                    'next' => null,
                    'prev' => null,

                ],
                'meta' => [
                    'current_page' => 1,
                    'from' => 1,
                    'last_page' => 1,
                    'path' => route('comments.index'),
                    'per_page' => 15,
                    'to' => 2,
                    'total' => 2,
                ],
            ]);
    }
}
