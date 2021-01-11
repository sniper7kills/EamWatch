<?php

namespace Tests\Unit\Models;

use App\Models\Message;
use App\Models\Recording;
use App\Models\User;
use Tests\TestCase;

class RecordingTest extends TestCase
{
    private function get_user()
    {
        return User::factory()->create();
    }

    private function get_message()
    {
        $message = Message::factory()->make();
        $message->user = $this->get_user();

        return $message;
    }

    public function test_recording_has_id_generated()
    {
        $recording = Recording::factory()->make();
        $recording->message = $this->get_message();
        $recording->user = $this->get_user();
        $recording->save();

        $this->assertNotNull($recording->id);
    }
}
