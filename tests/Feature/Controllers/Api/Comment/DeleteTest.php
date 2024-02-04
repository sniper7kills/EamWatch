<?php

namespace Tests\Feature\Controllers\Api\Comment;

use App\Models\Comment;
use App\Models\Guest;
use App\Models\Message;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Permission::create(['name' => 'delete comments']);
    }

    public function test_banned_guests_can_not_delete_comments(): void
    {
        $guest = Guest::current();
        $guest->banned = true;
        $guest->save();
        $message = Message::factory()->make();
        $message->user = $guest;
        $message->save();
        $comment = Comment::factory()->make();
        $comment->user = $guest;
        $message->comments()->save($comment);

        $this->json('delete', route('comments.destroy', ['comment' => $comment]))
            ->assertStatus(302)
            ->assertRedirectContains('/banned');
    }

    public function test_banned_users_can_not_delete_comments(): void
    {
        $user = User::factory()->create();
        $user->banned = true;
        $user->save();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();
        $comment = Comment::factory()->make();
        $comment->user = $user;
        $message->comments()->save($comment);

        $this->actingAs($user, 'api');
        $this->json('delete', route('comments.destroy', ['comment' => $comment]))
            ->assertStatus(302)
            ->assertRedirectContains('/banned');
    }

    public function test_guests_can_not_delete_comments_made_by_other_users(): void
    {
        $message = Message::factory()->make();
        $message->user = User::factory()->create();
        $message->save();
        $comment = Comment::factory()->make();
        $comment->user = User::factory()->create();
        $message->comments()->save($comment);

        $this->json('delete', route('comments.destroy', ['comment' => $comment]))
            ->assertStatus(403);
    }

    public function test_guests_can_not_delete_comments_made_by_other_guests(): void
    {
        $message = Message::factory()->make();
        $message->user = Guest::factory()->create();
        $message->save();
        $comment = Comment::factory()->make();
        $comment->user = Guest::factory()->create();
        $message->comments()->save($comment);

        $this->json('delete', route('comments.destroy', ['comment' => $comment]))
            ->assertStatus(403);
    }

    public function test_users_can_not_delete_comments_made_by_other_users(): void
    {
        $user = User::factory()->create();
        $message = Message::factory()->make();
        $message->user = User::factory()->create();
        $message->save();
        $comment = Comment::factory()->make();
        $comment->user = User::factory()->create();
        $message->comments()->save($comment);

        $this->actingAs($user, 'api');
        $this->json('delete', route('comments.destroy', ['comment' => $comment]))
            ->assertStatus(403);
    }

    public function test_users_can_not_delete_comments_made_by_other_guests(): void
    {
        $user = User::factory()->create();
        $message = Message::factory()->make();
        $message->user = Guest::factory()->create();
        $message->save();
        $comment = Comment::factory()->make();
        $comment->user = Guest::factory()->create();
        $message->comments()->save($comment);

        $this->actingAs($user, 'api');
        $this->json('delete', route('comments.destroy', ['comment' => $comment]))
            ->assertStatus(403);
    }

    public function test_users_can_delete_their_own_comments(): void
    {
        $user = User::factory()->create();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();
        $comment = Comment::factory()->make();
        $comment->user = $user;
        $message->comments()->save($comment);

        $this->actingAs($user, 'api');
        $this->json('delete', route('comments.destroy', ['comment' => $comment]))
            ->assertStatus(204);
    }

    public function test_guests_can_delete_their_own_comments(): void
    {
        $user = Guest::current();
        $message = Message::factory()->make();
        $message->user = $user;
        $message->save();
        $comment = Comment::factory()->make();
        $comment->user = $user;
        $message->comments()->save($comment);

        $this->json('delete', route('comments.destroy', ['comment' => $comment]))
            ->assertStatus(204);
    }

    public function test_admins_can_delete_comments(): void
    {
        $user = User::factory()->create();
        $user->givePermissionTo('delete comments');
        $message = Message::factory()->make();
        $message->user = User::factory()->create();
        $message->save();
        $comment = Comment::factory()->make();
        $comment->user = User::factory()->create();
        $message->comments()->save($comment);

        $this->actingAs($user, 'api');
        $this->json('delete', route('comments.destroy', ['comment' => $comment]))
            ->assertStatus(204);
    }
}
