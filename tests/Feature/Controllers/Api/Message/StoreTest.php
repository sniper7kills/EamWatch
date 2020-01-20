<?php

namespace Tests\Feature\Controllers\Api\Message;

use App\Models\Guest;
use App\Models\User;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class StoreTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Permission::create(['name' => 'create backend message']);
    }

    public function test_store_unavailable_for_banned_users()
    {
        $user = factory(User::class)->create();
        $user->banned = true;
        $user->save();
        $ts = Carbon::now()->toDateTimeString();

        $messageData = [
            'type' => 'allstations',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => 'this is a test message'
        ];

        $this->actingAs($user);
        $this->post(route('messages.store'),$messageData)
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
            'message' => 'this is a test message'
        ];

        $this->post(route('messages.store'),$messageData)
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
            'message' => 'this is a test message'
        ];

        $this->post(route('messages.store'),$messageData)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'type' => 'ALLSTATIONS',
                    'sender' => 'SENDER',
                    'receiver' => 'RECEIVER',
                    'time' => $ts,
                    'message' => 'THIS IS A TEST MESSAGE',
                    'user' => [
                        'name' => $guest->id
                    ]
                ]
            ]);
    }

    public function test_store_as_user()
    {
        $user = factory(User::class)->create();
        $ts = Carbon::now()->toDateTimeString();

        $messageData = [
            'type' => 'allstations',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => 'this is a test message'
        ];

        $this->actingAs($user);
        $this->post(route('messages.store'),$messageData)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'type' => 'ALLSTATIONS',
                    'sender' => 'SENDER',
                    'receiver' => 'RECEIVER',
                    'time' => $ts,
                    'message' => 'THIS IS A TEST MESSAGE',
                    'user' => [
                        'name' => $user->name
                    ]
                ]
            ]);
    }

    /**
     * Message Validation Rules
     */
    public function test_store_message_can_not_contain_http_link()
    {
        $ts = Carbon::now()->toDateTimeString();

        $messageData = [
            'type' => 'allstations',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => 'http://google.com'
        ];

        $this->json('post', route('messages.store'),$messageData)
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
            'message' => 'https://google.com'
        ];

        $this->json('post', route('messages.store'),$messageData)
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
            'message' => '<a href='
        ];

        $this->json('post', route('messages.store'),$messageData)
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
            'message' => '[URL='
        ];

        $this->json('post', route('messages.store'),$messageData)
            ->assertStatus(422)
            ->assertSee('The input appears to be spam.');
    }

    /**
     * Type Validation
     */
    public function test_store_message_type_must_be_valid()
    {
        $ts = Carbon::now()->toDateTimeString();

        $messageData = [
            'type' => '12345123',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => 'this is a test message'
        ];

        $this->json('post',route('messages.store'),$messageData)
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
            'message' => 'this is a test message'
        ];

        $this->json('post', route('messages.store'),$messageData)
            ->assertStatus(422)
            ->assertSee('Invalid Message Type Selected');
    }

    public function test_store_message_type_can_not_be_backend_for_users()
    {
        $user = factory(User::class)->create();
        $ts = Carbon::now()->toDateTimeString();

        $messageData = [
            'type' => 'backend',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => 'this is a test message'
        ];

        $this->actingAs($user);
        $this->json('post', route('messages.store'),$messageData)
            ->assertStatus(422)
            ->assertSee('Invalid Message Type Selected');
    }

    /**
     * Admin Related Tests
     */
    public function test_store_message_type_can_be_backend_for_admins()
    {
        $user = factory(User::class)->create();
        $user->givePermissionTo('create backend message');
        $ts = Carbon::now()->toDateTimeString();

        $messageData = [
            'type' => 'backend',
            'sender' => 'sender',
            'receiver' => 'receiver',
            'time' => $ts,
            'message' => 'this is a test message'
        ];

        $this->actingAs($user);
        $this->post(route('messages.store'),$messageData)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'type' => 'BACKEND',
                    'sender' => 'SENDER',
                    'receiver' => 'RECEIVER',
                    'time' => $ts,
                    'message' => 'THIS IS A TEST MESSAGE',
                    'user' => [
                        'name' => $user->name
                    ]
                ]
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
            'message' => 'this is a test message'
        ];

        $this->post(route('messages.store'),$messageData)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'type' => 'RADIOCHECK',
                    'sender' => 'SENDER',
                    'time' => $ts,
                    'message' => 'THIS IS A TEST MESSAGE',
                    'user' => [
                        'name' => $guest->id
                    ]
                ]
            ]);
    }
}
