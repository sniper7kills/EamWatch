<?php

namespace Tests\Feature\Controllers\Api\Message;

use App\Models\Guest;
use App\Models\Message;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class ShowTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Permission::create(['name' => 'update messages']);
        Permission::create(['name' => 'delete messages']);
    }

    public function test_message_show()
    {
        $guest = Guest::factory()->create();
        $message = Message::factory()->make();
        $message->user = $guest;
        $message->save();

        $this->get(route('messages.show', ['message' => $message]))
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
                        'name' => $guest->id,
                    ],
                    'comments' => [
                    ],
                    'recordings' => [
                    ],
                ],
            ]);
    }

    public function test_show_unavailable_for_banned_users()
    {
        $user = User::factory()->create();
        $user->banned = true;
        $user->save();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();

        $this->actingAs($user, 'api');
        $this->get(route('messages.show', ['message' => $message]))
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

        $this->get(route('messages.show', ['message' => $message]))
            ->assertStatus(403)
            ->assertSee('You are banned.');
    }

    public function test_show_contains_update_permissions_for_guest_who_created_message()
    {
        $guest = Guest::current();
        $message = Message::factory()->make();
        $message->user = $guest;
        $message->save();

        $this->get(route('messages.show', ['message' => $message]))
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
                        'name' => $guest->id,
                    ],
                    'comments' => [
                    ],
                    'recordings' => [
                    ],
                    'permissions' => [
                        'update' => true,
                        'delete' => false,
                    ],
                ],
            ]);
    }

    public function test_show_contains_update_permissions_for_user_who_created_message()
    {
        $user = User::factory()->create();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();

        $this->actingAs($user, 'api');
        $this->get(route('messages.show', ['message' => $message]))
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
                        'name' => $user->name,
                    ],
                    'comments' => [
                    ],
                    'recordings' => [
                    ],
                    'permissions' => [
                        'update' => true,
                        'delete' => false,
                    ],
                ],
            ]);
    }

    public function test_show_contains_update_permissions_for_admin_with_update_permission()
    {
        $user = User::factory()->create();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();

        $admin = User::factory()->create();
        $admin->givePermissionTo('update messages');
        $this->actingAs($admin);
        $this->get(route('messages.show', ['message' => $message]))
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
                        'name' => $user->name,
                    ],
                    'comments' => [
                    ],
                    'recordings' => [
                    ],
                    'permissions' => [
                        'update' => true,
                        'delete' => false,
                    ],
                ],
            ]);
    }

    public function test_show_contains_delete_permissions_for_admin_with_delete_permission()
    {
        $user = User::factory()->create();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();

        $admin = User::factory()->create();
        $admin->givePermissionTo('delete messages');
        $this->actingAs($admin);
        $this->get(route('messages.show', ['message' => $message]))
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
                        'name' => $user->name,
                    ],
                    'comments' => [
                    ],
                    'recordings' => [
                    ],
                    'permissions' => [
                        'update' => false,
                        'delete' => true,
                    ],
                ],
            ]);
    }
}
