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
            ->assertStatus(302)
            ->assertRedirectContains("/banned");
    }

    public function test_store_unavailable_for_banned_guests_redirects_to_login(): void
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
            ->assertStatus(302)
            ->assertRedirectContains("/login");
    }
}
