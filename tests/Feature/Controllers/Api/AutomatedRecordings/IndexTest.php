<?php

namespace Tests\Feature\Controllers\Api\AutomatedRecordings;

use App\Models\Guest;
use App\Models\Recording;
use App\Models\User;
use Tests\TestCase;

class IndexTest extends TestCase
{
    public function test_index_unavailable_for_banned_users(): void
    {
        $user = User::factory()->create();
        $user->banned = true;
        $user->save();
        $recording = Recording::factory()->make();
        $recording->user = $user;
        $recording->save();

        $this->actingAs($user, 'api');
        $this->json('get', route('automatedRecordings.index'))
            ->assertStatus(302)
            ->assertRedirectContains("/banned");
    }

    public function test_index_unavailable_for_banned_guests(): void
    {
        $user = Guest::current();
        $user->banned = true;
        $user->save();
        $recording = Recording::factory()->make();
        $recording->user = $user;
        $recording->save();

        $this->json('get', route('automatedRecordings.index'))
            ->assertStatus(302)
            ->assertRedirectContains("/banned");
    }

    public function test_index_displays_paginated_data(): void
    {
        $user = Guest::current();
        $recording = Recording::factory()->make(['automated' => true]);
        $recording->user = $user;
        $recording->save();

        $this->json('get', route('automatedRecordings.index'))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'id' => $recording->id,
                        'time' => $recording->time,
                        'frequency' => $recording->frequency,
                        'receiver' => $recording->receiver,
                        'link' => $recording->link,
                    ],
                ],
                'links' => [
                    'first' => route('automatedRecordings.index') . '?page=1',
                    'last' => route('automatedRecordings.index') . '?page=1',
                    'next' => null,
                    'prev' => null,

                ],
                'meta' => [
                    'current_page' => 1,
                    'from' => 1,
                    'last_page' => 1,
                    'path' => route('automatedRecordings.index'),
                    'per_page' => 15,
                    'to' => 1,
                    'total' => 1,
                ],
            ]);
    }
}
