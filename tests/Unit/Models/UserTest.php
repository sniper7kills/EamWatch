<?php


namespace Tests\Unit\Models;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_uuid_is_generated()
    {
        $user = factory(User::class)->create();
        $this->assertNotNull($user->id);
    }
}
