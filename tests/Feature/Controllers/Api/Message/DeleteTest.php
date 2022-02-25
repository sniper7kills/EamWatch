<?php

namespace Tests\Feature\Controllers\Api\Message;

use App\Models\Guest;
use App\Models\Message;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Permission::create(['name' => 'delete messages']);
    }

    public function test_guests_can_not_delete_messages()
    {
        $fakeGuest = Guest::factory()->create();
        $message = Message::factory()->make();
        $message->user = $fakeGuest;
        $message->save();

        $this->json('delete', route('messages.destroy', ['message' => $message]))
            ->assertStatus(401);
    }

    public function test_users_can_not_delete_messages()
    {
        $user = User::factory()->create();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();

        $this->actingAs($user, 'api');
        $this->json('delete', route('messages.destroy', ['message' => $message]))
            ->assertStatus(403);
    }

    public function test_admins_can_delete_messages()
    {
        $user = User::factory()->create();
        $user->givePermissionTo('delete messages');
        $user->save();

        $this->assertTrue($user->can('delete messages'));

        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();

        $this->assertTrue($user->can('delete messages'));
        $this->actingAs($user, 'api');

        $this->assertTrue($user->haspermissionTo('delete messages', 'web'));
        $this->json('delete', route('messages.destroy', ['message' => $message]))
            ->assertStatus(204);
    }
}
