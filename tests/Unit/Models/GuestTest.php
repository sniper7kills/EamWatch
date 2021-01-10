<?php

namespace Tests\Unit\Models;

use App\Models\Guest;
use Tests\TestCase;

class GuestTest extends TestCase
{
    public function test_guest_has_id_generated()
    {
        $guest = factory(Guest::class)->create();

        $this->assertNotNull($guest->id);
    }
}
