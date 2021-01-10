<?php

namespace Tests\Feature\Controllers\Api\Message;

use App\Models\Guest;
use App\Models\Message;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Permission::create(['name' => 'update messages']);
    }

    public function test_guest_can_not_update_message_created_by_other_guest()
    {
        $fakeGuest = Guest::factory()->create();
        $message = Message::factory()->make();
        $message->user = $fakeGuest;
        $message->save();

        $updateRequest = [
            'type' => 'skyking',
            'message' => 'This is a new message',
        ];

        $this->json('put', route('messages.update', ['message'=>$message]), $updateRequest)
            ->assertStatus(403)
            ->assertSee('You did not create this message');
    }

    public function test_guest_can_not_update_message_created_by_other_user()
    {
        $user = User::factory()->create();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();

        $updateRequest = [
            'type' => 'skyking',
            'message' => 'This is a new message',
        ];

        $this->json('put', route('messages.update', ['message'=>$message]), $updateRequest)
            ->assertStatus(403)
            ->assertSee('You did not create this message');
    }

    public function test_user_can_not_update_message_created_by_other_guest()
    {
        $fakeGuest = Guest::factory()->create();
        $message = Message::factory()->make();
        $message->user = $fakeGuest;
        $message->save();

        $updateRequest = [
            'type' => 'skyking',
            'message' => 'This is a new message',
        ];

        $this->actingAs(User::factory()->make());
        $this->json('put', route('messages.update', ['message'=>$message]), $updateRequest)
            ->assertStatus(403)
            ->assertSee('You did not create this message');
    }

    public function test_user_can_not_update_message_created_by_other_user()
    {
        $user = User::factory()->create();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();

        $updateRequest = [
            'type' => 'skyking',
            'message' => 'This is a new message',
        ];

        $this->actingAs(User::factory()->make());
        $this->json('put', route('messages.update', ['message'=>$message]), $updateRequest)
            ->assertStatus(403)
            ->assertSee('You did not create this message');
    }

    public function test_guest_can_update_message_they_submitted()
    {
        $user = Guest::current();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();

        $updateRequest = [
            'type' => 'skyking',
            'message' => 'This is a new message',
        ];

        $this->json('put', route('messages.update', ['message'=>$message]), $updateRequest)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $message->id,
                    'type' => 'SKYKING',
                    'sender' => $message->sender,
                    'receiver' => $message->receiver,
                    'time' => $message->broadcast_ts->toDateTimeString(),
                    'message' => 'THIS IS A NEW MESSAGE',
                    'user' => [
                        'name' => $user->id,
                    ],
                ],
            ]);
    }

    public function test_user_can_update_message_they_submitted()
    {
        $user = User::factory()->create();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();

        $updateRequest = [
            'type' => 'skyking',
            'message' => 'This is a new message',
        ];

        $this->actingAs($user, 'api');
        $this->json('put', route('messages.update', ['message'=>$message]), $updateRequest)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $message->id,
                    'type' => 'SKYKING',
                    'sender' => $message->sender,
                    'receiver' => $message->receiver,
                    'time' => $message->broadcast_ts->toDateTimeString(),
                    'message' => 'THIS IS A NEW MESSAGE',
                    'user' => [
                        'name' => $user->name,
                    ],
                ],
            ]);
    }

    public function test_guest_can_not_update_message_they_submitted_if_they_are_banned()
    {
        $user = Guest::current();
        $user->banned = true;
        $user->save();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();

        $updateRequest = [
            'type' => 'skyking',
            'message' => 'This is a new message',
        ];

        $this->json('put', route('messages.update', ['message'=>$message]), $updateRequest)
            ->assertStatus(403)
            ->assertSee('You are banned.');
    }

    public function test_user_can_not_update_message_they_submitted_if_they_are_banned()
    {
        $user = User::factory()->create();
        $user->banned = true;
        $user->save();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();

        $updateRequest = [
            'type' => 'skyking',
            'message' => 'This is a new message',
        ];

        $this->actingAs($user, 'api');
        $this->json('put', route('messages.update', ['message'=>$message]), $updateRequest)
            ->assertStatus(403)
            ->assertSee('You are banned.');
    }

    public function test_admins_can_update_messages_created_by_other_guests()
    {
        $user = User::factory()->create();
        $user->givePermissionTo('update messages');
        $message = Message::factory()->make();
        $guest = Guest::factory()->create();
        $message->user = $guest;
        $message->save();

        $updateRequest = [
            'type' => 'skyking',
            'message' => 'This is a new message',
        ];

        $this->actingAs($user, 'api');
        $this->json('put', route('messages.update', ['message'=>$message]), $updateRequest)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $message->id,
                    'type' => 'SKYKING',
                    'sender' => $message->sender,
                    'receiver' => $message->receiver,
                    'time' => $message->broadcast_ts->toDateTimeString(),
                    'message' => 'THIS IS A NEW MESSAGE',
                    'user' => [
                        'name' => $guest->id,
                    ],
                ],
            ]);
    }

    public function test_admins_can_update_messages_created_by_other_users()
    {
        $user = User::factory()->create();
        $user->givePermissionTo('update messages');
        $user2 = User::factory()->create();
        $message = Message::factory()->make();
        $message->user = $user2;
        $message->save();

        $updateRequest = [
            'type' => 'skyking',
            'message' => 'This is a new message',
        ];

        $this->actingAs($user, 'api');
        $this->json('put', route('messages.update', ['message'=>$message]), $updateRequest)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $message->id,
                    'type' => 'SKYKING',
                    'sender' => $message->sender,
                    'receiver' => $message->receiver,
                    'time' => $message->broadcast_ts->toDateTimeString(),
                    'message' => 'THIS IS A NEW MESSAGE',
                    'user' => [
                        'name' => $user2->name,
                    ],
                ],
            ]);
    }
}
