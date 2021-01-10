<?php

namespace Tests\Feature\Controllers\Api\Recordings;

use App\Models\Guest;
use App\Models\Message;
use App\Models\Recording;
use App\Models\User;
use Tests\TestCase;

class ShowTest extends TestCase
{
    public function test_show_unavailable_for_banned_users()
    {
        $user = User::factory()->create();
        $user->banned = true;
        $user->save();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();
        $recording = Recording::factory()->make();
        $recording->message = $message;
        $recording->user = $user;
        $recording->save();

        $this->actingAs($user, 'api');
        $this->json('get', route('recordings.show', ['recording'=>$recording]))
            ->assertStatus(403)
            ->assertSee('You are banned.');
    }

    public function test_show_unavailable_for_banned_guests()
    {
        $user = Guest::current();
        $user->banned = true;
        $user->save();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();
        $recording = Recording::factory()->make();
        $recording->message = $message;
        $recording->user = $user;
        $recording->save();

        $this->json('get', route('recordings.show', ['recording'=>$recording]))
            ->assertStatus(403)
            ->assertSee('You are banned.');
    }

    public function test_recording_show()
    {
        $user = Guest::current();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();
        $recording = Recording::factory()->make();
        $recording->message = $message;
        $recording->user = $user;
        $recording->save();

        $this->json('get', route('recordings.show', ['recording'=>$recording]))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $recording->id,
                    'link' => $recording->link,
                    'frequency' => $recording->frequency,
                    'receiver' => $recording->receiver,
                    'time' => $recording->time,
                    'message' => [
                        'id' => $message->id,
                        'type' => $message->type,
                        'time' => $message->time,
                    ],
                    'user' => [
                        'name' => $user->id,
                    ],
                ],
            ]);
    }
}
