<?php

namespace Tests\Unit\Models;

use App\Models\Message;
use App\Models\User;
use Tests\TestCase;

class MessageTest extends TestCase
{
    private function getUserModel()
    {
        return User::factory()->create();
    }

    public function test_message_can_have_user_attribute_set()
    {
        $message = Message::factory()->make();
        $user = $this->getUserModel();
        $message->user = $user;
        $message->save();

        $this->assertEquals($user->getKey(), $message->userable->getKey());
        $this->assertEquals($user->getMorphClass(), $message->userable->getMorphClass());
    }

    public function test_message_has_upper_case_messages()
    {
        $message = Message::factory()->make(['message' => 'this is a test message']);
        $user = $this->getUserModel();
        $message->user = $user;
        $message->save();

        $this->assertEquals('THIS IS A TEST MESSAGE', $message->message);
    }

    public function test_message_type_can_be_radiocheck()
    {
        $message = Message::factory()->make(['type' => 'radiocheck']);
        $message->user = $this->getUserModel();
        $message->save();
        $this->assertEquals('RADIOCHECK', $message->type);
    }

    public function test_message_type_can_be_allstations()
    {
        $message = Message::factory()->make(['type' => 'allstations']);
        $message->user = $this->getUserModel();
        $message->save();
        $this->assertEquals('ALLSTATIONS', $message->type);
    }

    public function test_message_type_can_be_skyking()
    {
        $message = Message::factory()->make(['type' => 'skyking']);
        $message->user = $this->getUserModel();
        $message->save();
        $this->assertEquals('SKYKING', $message->type);
    }

    public function test_message_type_can_be_skymaster()
    {
        $message = Message::factory()->make(['type' => 'skymaster']);
        $message->user = $this->getUserModel();
        $message->save();
        $this->assertEquals('SKYMASTER', $message->type);
    }

    public function test_message_type_can_be_skybird()
    {
        $message = Message::factory()->make(['type' => 'skybird']);
        $message->user = $this->getUserModel();
        $message->save();
        $this->assertEquals('SKYBIRD', $message->type);
    }

    public function test_message_type_can_be_other()
    {
        $message = Message::factory()->make(['type' => 'other']);
        $message->user = $this->getUserModel();
        $message->save();
        $this->assertEquals('OTHER', $message->type);
    }

    public function test_message_type_can_be_disregarded()
    {
        $message = Message::factory()->make(['type' => 'disregarded']);
        $message->user = $this->getUserModel();
        $message->save();
        $this->assertEquals('DISREGARDED', $message->type);
    }

    public function test_message_type_can_be_backend()
    {
        $message = Message::factory()->make(['type' => 'backend']);
        $message->user = $this->getUserModel();
        $message->save();
        $this->assertEquals('BACKEND', $message->type);
    }
}
