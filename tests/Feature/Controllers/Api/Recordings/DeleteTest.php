<?php

namespace Tests\Feature\Controllers\Api\Recordings;

use App\Models\Guest;
use App\Models\Message;
use App\Models\Recording;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Permission::create(['name' => 'delete recordings']);
    }

    public function test_guests_can_not_delete_recordings()
    {
        $fakeGuest = factory(Guest::class)->create();
        $message = factory(Message::class)->make();
        $message->user = $fakeGuest;
        $message->save();
        $recording = factory(Recording::class)->make();
        $recording->message = $message;
        $recording->user = $fakeGuest;
        $recording->save();

        $this->json('delete', route('recordings.destroy', ['recording'=>$recording]))
            ->assertStatus(403);
    }

    public function test_users_can_not_delete_recordings()
    {
        $user = factory(User::class)->create();
        $message = factory(Message::class)->make();
        $message->user = $user;
        $message->save();
        $recording = factory(Recording::class)->make();
        $recording->message = $message;
        $recording->user = $user;
        $recording->save();

        $this->actingAs($user);
        $this->json('delete', route('recordings.destroy', ['recording'=>$recording]))
            ->assertStatus(403);
    }

    public function test_admins_can_delete_recordings()
    {
        $user = factory(User::class)->create();
        $user->givePermissionTo('delete recordings');
        $message = factory(Message::class)->make();
        $message->user = $user;
        $message->save();
        $recording = factory(Recording::class)->make();
        $recording->message = $message;
        $recording->user = $user;
        $recording->save();

        $this->actingAs($user);
        $this->json('delete', route('recordings.destroy', ['recording'=>$recording]))
            ->assertStatus(204);
    }
}
