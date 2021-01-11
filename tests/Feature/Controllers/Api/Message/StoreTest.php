<?php

namespace Tests\Feature\Controllers\Api\Message;

use App\Models\Guest;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class StoreTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Permission::create(['name' => 'create backend message']);
    }

    public function test_store_unavailable_for_banned_users()
    {
        $user = User::factory()->create();
        $user->banned = true;
        $user->save();
        $ts = Carbon::now()->toDateTimeString();

        $messageData = [
            'type' => 'allstations',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => 'this is a test message',
        ];

        $this->actingAs($user, 'api');
        $this->post(route('messages.store'), $messageData)
            ->assertStatus(403)
            ->assertSee('You are banned.');
    }

    public function test_store_unavailable_for_banned_guests()
    {
        $user = Guest::current();
        $user->banned = true;
        $user->save();
        $ts = Carbon::now()->toDateTimeString();

        $messageData = [
            'type' => 'allstations',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => 'this is a test message',
        ];

        $this->post(route('messages.store'), $messageData)
            ->assertStatus(403)
            ->assertSee('You are banned.');
    }

    public function test_store_as_guest()
    {
        $guest = Guest::current();
        $ts = Carbon::now()->toDateTimeString();

        $messageData = [
            'type' => 'allstations',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => 'thisisatestmessage',
        ];

        $this->post(route('messages.store'), $messageData)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'type' => 'ALLSTATIONS',
                    'sender' => 'SENDER',
                    'receiver' => 'RECEIVER',
                    'time' => $ts,
                    'message' => 'THISISATESTMESSAGE',
                    'user' => [
                        'name' => $guest->id,
                    ],
                ],
            ]);
    }

    public function test_store_as_user()
    {
        $user = User::factory()->create();
        $ts = Carbon::now()->toDateTimeString();

        $messageData = [
            'type' => 'allstations',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => 'thisisatestmessage',
        ];

        $this->actingAs($user, 'api');
        $this->post(route('messages.store'), $messageData)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'type' => 'ALLSTATIONS',
                    'sender' => 'SENDER',
                    'receiver' => 'RECEIVER',
                    'time' => $ts,
                    'message' => 'THISISATESTMESSAGE',
                    'user' => [
                        'name' => $user->name,
                    ],
                ],
            ]);
    }

    /**
     * Message Validation Rules.
     */
    public function test_store_message_can_not_contain_http_link()
    {
        $ts = Carbon::now()->toDateTimeString();

        $messageData = [
            'type' => 'allstations',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => 'http://google.com',
        ];

        $this->json('post', route('messages.store'), $messageData)
            ->assertStatus(422)
            ->assertSee('The input appears to be spam.');
    }

    public function test_store_message_can_not_contain_https_link()
    {
        $ts = Carbon::now()->toDateTimeString();

        $messageData = [
            'type' => 'allstations',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => 'https://google.com',
        ];

        $this->json('post', route('messages.store'), $messageData)
            ->assertStatus(422)
            ->assertSee('The input appears to be spam.');
    }

    public function test_store_message_can_not_contain_a_href()
    {
        $ts = Carbon::now()->toDateTimeString();

        $messageData = [
            'type' => 'allstations',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => '<a href=',
        ];

        $this->json('post', route('messages.store'), $messageData)
            ->assertStatus(422)
            ->assertSee('The input appears to be spam.');
    }

    public function test_store_message_can_not_contain_url_tag()
    {
        $ts = Carbon::now()->toDateTimeString();

        $messageData = [
            'type' => 'allstations',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => '[URL=',
        ];

        $this->json('post', route('messages.store'), $messageData)
            ->assertStatus(422)
            ->assertSee('The input appears to be spam.');
    }

    /**
     * Type Validation.
     */
    public function test_store_message_type_must_be_valid()
    {
        $ts = Carbon::now()->toDateTimeString();

        $messageData = [
            'type' => '12345123',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => 'this is a test message',
        ];

        $this->json('post', route('messages.store'), $messageData)
            ->assertStatus(422)
            ->assertSee('Invalid Message Type Selected');
    }

    public function test_store_message_type_can_not_be_backend_for_guests()
    {
        $ts = Carbon::now()->toDateTimeString();

        $messageData = [
            'type' => 'backend',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => 'this is a test message',
        ];

        $this->json('post', route('messages.store'), $messageData)
            ->assertStatus(422)
            ->assertSee('Invalid Message Type Selected');
    }

    public function test_store_message_type_can_not_be_backend_for_users()
    {
        $user = User::factory()->create();
        $ts = Carbon::now()->toDateTimeString();

        $messageData = [
            'type' => 'backend',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => 'this is a test message',
        ];

        $this->actingAs($user, 'api');
        $this->json('post', route('messages.store'), $messageData)
            ->assertStatus(422)
            ->assertSee('Invalid Message Type Selected');
    }

    /**
     * Admin Related Tests.
     */
    public function test_store_message_type_can_be_backend_for_admins()
    {
        $user = User::factory()->create();
        $user->givePermissionTo('create backend message');
        $ts = Carbon::now()->toDateTimeString();

        $messageData = [
            'type' => 'backend',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => 'this is a test message',
        ];

        $this->actingAs($user, 'api');
        $this->post(route('messages.store'), $messageData)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'type' => 'BACKEND',
                    'sender' => 'SENDER',
                    'receiver' => 'RECEIVER',
                    'time' => $ts,
                    'message' => 'THIS IS A TEST MESSAGE',
                    'user' => [
                        'name' => $user->name,
                    ],
                ],
            ]);
    }

    public function test_radiocheck_does_not_require_a_receiver()
    {
        $guest = Guest::current();
        $ts = Carbon::now()->toDateTimeString();

        $messageData = [
            'type' => 'radiocheck',
            'sender' => 'sender',
            'receiver' => null,
            'time' => $ts,
            'message' => 'this is a test message',
        ];

        $this->post(route('messages.store'), $messageData)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'type' => 'RADIOCHECK',
                    'sender' => 'SENDER',
                    'time' => $ts,
                    'message' => 'THIS IS A TEST MESSAGE',
                    'user' => [
                        'name' => $guest->id,
                    ],
                ],
            ]);
    }

    public function test_message_can_not_be_the_same_within_3_min()
    {
        $user = User::factory()->create();
        $ts = Carbon::now();

        $messageData = [
            'type' => 'allstations',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts->toDateTimeString(),
            'message' => 'thisisatestmessage123',
        ];

        $this->actingAs($user, 'api');
        $this->post(route('messages.store'), $messageData)
            ->assertStatus(201);

        $messageData['time'] = $ts->addMinutes(2)->toDateTimeString();

        $this->post(route('messages.store'), $messageData)
            ->assertStatus(303);

        $this->assertCount(1, Message::all());
    }

    public function test_allstation_message_can_not_contain_spaces()
    {
        $user = User::factory()->create();
        $ts = Carbon::now();

        $messageData = [
            'type' => 'allstations',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts->toDateTimeString(),
            'message' => 'this is a test message',
        ];

        $this->actingAs($user, 'api');
        $this->post(route('messages.store'), $messageData)
            ->assertStatus(302);
    }

    public function test_allstation_message_can_not_contain_dashes()
    {
        $user = User::factory()->create();
        $ts = Carbon::now();

        $messageData = [
            'type' => 'allstations',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts->toDateTimeString(),
            'message' => 'this-is-a-test-message',
        ];

        $this->actingAs($user, 'api');
        $this->post(route('messages.store'), $messageData)
            ->assertStatus(302);
    }

    public function test_skyking_message_must_follow_regex()
    {
        $user = User::factory()->create();
        $ts = Carbon::now();

        $messageData = [
            'type' => 'skyking',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts->toDateTimeString(),
            'message' => 'abd TIME 44 AUTH AV',
        ];

        $this->actingAs($user, 'api');
        $this->post(route('messages.store'), $messageData)
            ->assertStatus(201);
    }

    public function test_skyking_message_must_only_contain_alpha_numerica_before_time()
    {
        $user = User::factory()->create();
        $ts = Carbon::now();

        $messageData = [
            'type' => 'skyking',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts->toDateTimeString(),
            'message' => 'ab3 TIME 44 AUTH AV',
        ];

        $this->actingAs($user, 'api');
        $this->post(route('messages.store'), $messageData)
            ->assertStatus(302);
    }

    public function test_skyking_message_must_only_contain_numerica_for_time()
    {
        $user = User::factory()->create();
        $ts = Carbon::now();

        $messageData = [
            'type' => 'skyking',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts->toDateTimeString(),
            'message' => 'The Who TIME A4 AUTH AV',
        ];

        $this->actingAs($user, 'api');
        $this->post(route('messages.store'), $messageData)
            ->assertStatus(302);
    }

    public function test_skyking_message_must_only_contain_alpha_for_auth()
    {
        $user = User::factory()->create();
        $ts = Carbon::now();

        $messageData = [
            'type' => 'skyking',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts->toDateTimeString(),
            'message' => 'The Who TIME 44 AUTH 3B',
        ];

        $this->actingAs($user, 'api');
        $this->post(route('messages.store'), $messageData)
            ->assertStatus(302);
    }
}
