<?php

namespace Tests\Unit\Models;

use App\Models\Guest;
use Tests\TestCase;

class GuestTest extends TestCase
{
    public function test_guest_has_id_generated(): void
    {
        $guest = Guest::factory()->create();

        $this->assertNotNull($guest->id);
    }
}
