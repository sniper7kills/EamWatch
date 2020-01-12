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
    public function setUp(): void
    {
        parent::setUp();
        Permission::create(['name' => 'delete comments']);
    }

    public function test_banned_guests_can_not_delete_comments()
    {
        $guest = Guest::current();
        $guest->banned = true;
        $guest->save();
        $message = factory(Message::class)->make();
        $message->user = $guest;
        $message->save();
        $comment = factory(Comment::class)->make();
        $comment->user = $guest;
        $message->comments()->save($comment);

        $this->json('delete', route('comments.destroy', ['comment' => $comment]))
            ->assertStatus(403)
            ->assertSee('You are banned.');
    }

    public function test_banned_users_can_not_delete_comments()
    {
        $user = factory(User::class)->create();
        $user->banned = true;
        $user->save();
        $message = factory(Message::class)->make();
        $message->user = $user;
        $message->save();
        $comment = factory(Comment::class)->make();
        $comment->user = $user;
        $message->comments()->save($comment);

        $this->actingAs($user);
        $this->json('delete', route('comments.destroy', ['comment' => $comment]))
            ->assertStatus(403)
            ->assertSee('You are banned.');
    }

    public function test_guests_can_not_delete_comments_made_by_other_users()
    {
        $message = factory(Message::class)->make();
        $message->user = factory(User::class)->create();
        $message->save();
        $comment = factory(Comment::class)->make();
        $comment->user = factory(User::class)->create();
        $message->comments()->save($comment);

        $this->json('delete', route('comments.destroy', ['comment' => $comment]))
            ->assertStatus(403);
    }

    public function test_guests_can_not_delete_comments_made_by_other_guests()
    {
        $message = factory(Message::class)->make();
        $message->user = factory(Guest::class)->create();
        $message->save();
        $comment = factory(Comment::class)->make();
        $comment->user = factory(Guest::class)->create();
        $message->comments()->save($comment);

        $this->json('delete', route('comments.destroy', ['comment' => $comment]))
            ->assertStatus(403);
    }

    public function test_users_can_not_delete_comments_made_by_other_users()
    {
        $user = factory(User::class)->create();
        $message = factory(Message::class)->make();
        $message->user = factory(User::class)->create();
        $message->save();
        $comment = factory(Comment::class)->make();
        $comment->user = factory(User::class)->create();
        $message->comments()->save($comment);

        $this->actingAs($user);
        $this->json('delete', route('comments.destroy', ['comment' => $comment]))
            ->assertStatus(403);
    }

    public function test_users_can_not_delete_comments_made_by_other_guests()
    {
        $user = factory(User::class)->create();
        $message = factory(Message::class)->make();
        $message->user = factory(Guest::class)->create();
        $message->save();
        $comment = factory(Comment::class)->make();
        $comment->user = factory(Guest::class)->create();
        $message->comments()->save($comment);

        $this->actingAs($user);
        $this->json('delete', route('comments.destroy', ['comment' => $comment]))
            ->assertStatus(403);
    }

    public function test_users_can_delete_their_own_comments()
    {
        $user = factory(User::class)->create();
        $message = factory(Message::class)->make();
        $message->user = $user;
        $message->save();
        $comment = factory(Comment::class)->make();
        $comment->user = $user;
        $message->comments()->save($comment);

        $this->actingAs($user);
        $this->json('delete', route('comments.destroy', ['comment' => $comment]))
            ->assertStatus(204);
    }

    public function test_guests_can_delete_their_own_comments()
    {
        $user = Guest::current();
        $message = factory(Message::class)->make();
        $message->user = $user;
        $message->save();
        $comment = factory(Comment::class)->make();
        $comment->user = $user;
        $message->comments()->save($comment);

        $this->json('delete', route('comments.destroy', ['comment' => $comment]))
            ->assertStatus(204);
    }

    public function test_admins_can_delete_comments()
    {
        $user = factory(User::class)->create();
        $user->givePermissionTo('delete comments');
        $message = factory(Message::class)->make();
        $message->user = factory(User::class)->create();
        $message->save();
        $comment = factory(Comment::class)->make();
        $comment->user = factory(User::class)->create();
        $message->comments()->save($comment);

        $this->actingAs($user);
        $this->json('delete', route('comments.destroy', ['comment' => $comment]))
            ->assertStatus(204);
    }
}
