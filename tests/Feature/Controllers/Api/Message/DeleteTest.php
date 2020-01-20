<?php

namespace Tests\Feature\Controllers\Api\Message;

use App\Models\Guest;
use App\Models\Message;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Permission::create(['name' => 'delete messages']);
    }

    public function test_guests_can_not_delete_messages()
    {
        $fakeGuest = factory(Guest::class)->create();
        $message = factory(Message::class)->make();
        $message->user = $fakeGuest;
        $message->save();

        $this->json('delete', route('messages.destroy', ['message'=>$message]))
            ->assertStatus(401);
    }

    public function test_users_can_not_delete_messages()
    {
        $user = factory(User::class)->create();
        $message = factory(Message::class)->make();
        $message->user = $user;
        $message->save();

        $this->actingAs($user,'api');
        $this->json('delete', route('messages.destroy', ['message'=>$message]))
            ->assertStatus(403);
    }

    public function test_admins_can_delete_messages()
    {
        $user = factory(User::class)->create();
        $user->givePermissionTo('delete messages');

        $message = factory(Message::class)->make();
        $message->user = $user;
        $message->save();

        $this->actingAs($user, 'api');
        $this->json('delete', route('messages.destroy', ['message'=>$message]))
            ->assertStatus(204);
    }
}
