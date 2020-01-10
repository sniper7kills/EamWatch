<?php

namespace Tests\Feature\Controllers\Api\Message;

use App\Models\Guest;
use App\Models\Message;
use App\Models\User;
use Tests\TestCase;

class ShowTest extends TestCase
{
    public function test_message_show()
    {
        $guest = factory(Guest::class)->create();
        $message = factory(Message::class)->make();
        $message->user = $guest;
        $message->save();

        $this->get(route('messages.show',['message'=>$message]))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
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
                        'name' => $guest->id
                    ],
                    'comments' => [
                    ],
                    'recordings' => [
                    ]
                ]
            ]);
    }

    public function test_show_unavailable_for_banned_users()
    {
        $user = factory(User::class)->create();
        $user->banned = true;
        $user->save();
        $message = factory(Message::class)->make();
        $message->user = $user;
        $message->save();

        $this->actingAs($user);
        $this->get(route('messages.show',['message'=>$message]))
            ->assertStatus(403)
            ->assertSee('You are banned.');
    }

    public function test_show_unavailable_for_banned_guests()
    {
        $user = Guest::current();
        $user->banned = true;
        $user->save();
        $message = factory(Message::class)->make();
        $message->user = $user;
        $message->save();

        $this->get(route('messages.show',['message'=>$message]))
            ->assertStatus(403)
            ->assertSee('You are banned.');
    }
}
