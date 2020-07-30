<?php

namespace Tests\Feature\Controllers\Api\Comment;

use App\Models\Guest;
use App\Models\Message;
use App\Models\Recording;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class StoreTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Permission::create(['name' => 'update comments']);
        Permission::create(['name' => 'delete comments']);
    }

    public function test_banned_guests_can_not_create_comment()
    {
        $guest = Guest::current();
        $guest->banned = true;
        $guest->save();

        $message = factory(Message::class)->make();
        $message->user = $guest;
        $message->save();

        $messageData = [
            'message' => 'This is a test comment',
            'message_id' => $message->id,
        ];

        $this->json('post', route('comments.store'), $messageData)
            ->assertStatus(403);
    }

    public function test_banned_users_can_not_create_comment()
    {
        $user = factory(User::class)->create();
        $user->banned = true;
        $user->save();

        $message = factory(Message::class)->make();
        $message->user = $user;
        $message->save();

        $messageData = [
            'message' => 'This is a test comment',
            'message_id' => $message->id,
        ];

        $this->actingAs($user, 'api');
        $this->json('post', route('comments.store'), $messageData)
            ->assertStatus(403);
    }

    public function test_message_id_or_recording_id_required()
    {
        $user = factory(User::class)->create();

        $messageData = [
            'message' => 'This is a test comment',
        ];

        $this->actingAs($user, 'api');
        $this->json('post', route('comments.store'), $messageData)
            ->assertStatus(422);
    }

    public function test_guest_can_create_comment_on_message()
    {
        $user = Guest::current();

        $message = factory(Message::class)->make();
        $message->user = $user;
        $message->save();

        $messageData = [
            'message' => 'This is a test comment',
            'message_id' => $message->id,
        ];

        $this->json('post', route('comments.store'), $messageData)
            ->assertStatus(201);
    }

    public function test_user_can_create_comment_on_message()
    {
        $user = factory(User::class)->create();

        $message = factory(Message::class)->make();
        $message->user = $user;
        $message->save();

        $messageData = [
            'message' => 'This is a test comment',
            'message_id' => $message->id,
        ];

        $this->actingAs($user, 'api');
        $this->json('post', route('comments.store'), $messageData)
            ->assertStatus(201);
    }

    public function test_guest_can_create_comment_on_recording()
    {
        $user = Guest::current();

        $message = factory(Message::class)->make();
        $message->user = $user;
        $message->save();

        $recording = factory(Recording::class)->make();
        $recording->user = $user;
        $recording->message = $message;
        $recording->save();

        $messageData = [
            'message' => 'This is a test comment',
            'recording_id' => $recording->id,
        ];

        $this->json('post', route('comments.store'), $messageData)
            ->assertStatus(201);
    }

    public function test_user_can_create_comment_on_recording()
    {
        $user = factory(User::class)->create();

        $message = factory(Message::class)->make();
        $message->user = $user;
        $message->save();

        $recording = factory(Recording::class)->make();
        $recording->user = $user;
        $recording->message = $message;
        $recording->save();

        $messageData = [
            'message' => 'This is a test comment',
            'recording_id' => $recording->id,
        ];

        $this->actingAs($user, 'api');
        $this->json('post', route('comments.store'), $messageData)
            ->assertStatus(201);
    }
}
