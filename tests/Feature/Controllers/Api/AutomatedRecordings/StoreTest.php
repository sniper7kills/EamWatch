<?php

namespace Tests\Feature\Controllers\Api\AutomatedRecordings;

use App\Models\Guest;
use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class StoreTest extends TestCase
{
    public function test_store_unavailable_for_banned_users(): void
    {
        $user = User::factory()->create();
        $user->banned = true;
        $user->save();
        $ts = Carbon::now()->toDateTimeString();

        $recordingData = [
            'type' => 'allstations',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => 'this is a test message',
        ];

        $this->actingAs($user, 'api');
        $this->post(route('automatedRecordings.store'), $recordingData)
            ->assertStatus(403)
            ->assertSee('You are banned.');
    }

    public function test_store_unavailable_for_banned_guests(): void
    {
        $user = Guest::current();
        $user->banned = true;
        $user->save();
        $ts = Carbon::now()->toDateTimeString();

        $recordingData = [
            'type' => 'allstations',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => 'this is a test message',
        ];

        $this->post(route('automatedRecordings.store'), $recordingData)
            ->assertStatus(403)
            ->assertSee('You are banned.');
    }
}
