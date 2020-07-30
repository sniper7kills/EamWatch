<?php

namespace Tests\Feature\Controllers\Api\Message;

use App\Models\Guest;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class IndexTest extends TestCase
{
    public function test_index_is_paginated()
    {
        $user = factory(User::class)->create();
        $message = factory(Message::class)->make();
        $message->user = $user;
        $message->save();

        $guest = factory(Guest::class)->create();
        $message2 = factory(Message::class)->make();
        $message2->user = $guest;
        $message2->save();

        $this->get(route('messages.index'))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => $message->id,
                        'type' => $message->type,
                        'sender' => $message->sender,
                        'receiver' => $message->receiver,
                        'time' => $message->broadcast_ts->toDateTimeString(),
                        'message' => $message->message,
                        'comment_count' => 0,
                        'recording_count' => 0,
                        'rating' => 0,
                        'user' => [
                            'name' => $user->name,
                        ],
                        'comments' => [
                        ],
                        'recordings' => [
                        ],
                    ],
                    [
                        'id' => $message2->id,
                        'type' => $message2->type,
                        'sender' => $message2->sender,
                        'receiver' => $message2->receiver,
                        'time' => $message2->broadcast_ts->toDateTimeString(),
                        'message' => $message2->message,
                        'comment_count' => 0,
                        'recording_count' => 0,
                        'rating' => 0,
                        'user' => [
                            'name' => $guest->id,
                        ],
                        'comments' => [
                        ],
                        'recordings' => [
                        ],
                    ],
                ],
                'links' => [
                    'first' => route('messages.index').'?page=1',
                    'last' => route('messages.index').'?page=1',
                    'next' => null,
                    'prev' => null,

                ],
                'meta' => [
                    'current_page' => 1,
                    'from' => 1,
                    'last_page' => 1,
                    'path' => route('messages.index'),
                    'per_page' => 15,
                    'to' => 2,
                    'total' => 2,
                ],
            ]);
    }

    public function test_index_unavailable_for_banned_users()
    {
        $user = factory(User::class)->create();
        $user->banned = true;
        $user->save();
        $message = factory(Message::class)->make();
        $message->user = $user;
        $message->save();

        $this->actingAs($user, 'api');
        $this->get(route('messages.index'))
            ->assertStatus(403)
            ->assertSee('You are banned.');
    }

    public function test_index_unavailable_for_banned_guests()
    {
        $user = Guest::current();
        $user->banned = true;
        $user->save();
        $message = factory(Message::class)->make();
        $message->user = $user;
        $message->save();

        $this->get(route('messages.index'))
            ->assertStatus(403)
            ->assertSee('You are banned.');
    }

    public function test_index_results_are_ordered_by_broadcast_time()
    {
        $user = factory(User::class)->create();
        $message = factory(Message::class)->make();
        $message->user = $user;
        $message->save();

        $guest = factory(Guest::class)->create();
        $message2 = factory(Message::class)->make();
        $message2->time = Carbon::now()->addHour();
        $message2->user = $guest;
        $message2->save();

        $this->get(route('messages.index').'?per_page=1')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => $message2->id,
                        'type' => $message2->type,
                        'sender' => $message2->sender,
                        'receiver' => $message2->receiver,
                        'time' => $message2->broadcast_ts->toDateTimeString(),
                        'message' => $message2->message,
                        'comment_count' => 0,
                        'recording_count' => 0,
                        'rating' => 0,
                        'user' => [
                            'name' => $guest->id,
                        ],
                        'comments' => [
                        ],
                        'recordings' => [
                        ],
                    ],
                ],
            ]);
    }
}
