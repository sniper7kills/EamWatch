<?php

namespace Tests\Feature\Controllers\Api\Comment;

use App\Models\Comment;
use App\Models\Guest;
use App\Models\Message;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class ShowTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Permission::create(['name' => 'update comments']);
        Permission::create(['name' => 'delete comments']);
    }

    public function test_show_contains_update_and_delete_permissions_for_guest_who_created_comment()
    {
        $guest = Guest::current();
        $message = Message::factory()->make();
        $message->user = $guest;
        $message->save();
        $comment = Comment::factory()->make();
        $comment->message = $message;
        $comment->user = $guest;
        $comment->save();

        $this->get(route('comments.show', ['comment' => $comment]))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $comment->id,
                    'comment' => $comment->message,
                    'user' => [
                        'name' => $guest->id,
                    ],
                    'permissions' => [
                        'update' => true,
                        'delete' => true,
                    ],
                ],
            ]);
    }

    public function test_show_contains_update_and_delete_permissions_for_user_who_created_comment()
    {
        $user = User::factory()->create();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();
        $comment = Comment::factory()->make();
        $comment->message = $message;
        $comment->user = $user;
        $comment->save();

        $this->actingAs($user, 'api');
        $this->get(route('comments.show', ['comment' => $comment]))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $comment->id,
                    'comment' => $comment->message,
                    'user' => [
                        'name' => $user->name,
                    ],
                    'permissions' => [
                        'update' => true,
                        'delete' => true,
                    ],
                ],
            ]);
    }

    public function test_show_contains_update_permission_for_admin_with_update_permission()
    {
        $user = User::factory()->create();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();
        $comment = Comment::factory()->make();
        $comment->message = $message;
        $comment->user = $user;
        $comment->save();

        $admin = User::factory()->create();
        $admin->givePermissionTo('update comments');

        $this->actingAs($admin);
        $this->get(route('comments.show', ['comment' => $comment]))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $comment->id,
                    'comment' => $comment->message,
                    'user' => [
                        'name' => $user->name,
                    ],
                    'permissions' => [
                        'update' => true,
                        'delete' => false,
                    ],
                ],
            ]);
    }

    public function test_show_contains_delete_permission_for_admin_with_delete_permission()
    {
        $user = User::factory()->create();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();
        $comment = Comment::factory()->make();
        $comment->message = $message;
        $comment->user = $user;
        $comment->save();

        $admin = User::factory()->create();
        $admin->givePermissionTo('delete comments');

        $this->actingAs($admin);
        $this->get(route('comments.show', ['comment' => $comment]))
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $comment->id,
                    'comment' => $comment->message,
                    'user' => [
                        'name' => $user->name,
                    ],
                    'permissions' => [
                        'update' => false,
                        'delete' => true,
                    ],
                ],
            ]);
    }
}
