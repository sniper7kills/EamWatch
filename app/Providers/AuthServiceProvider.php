<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Guest;
use App\Models\Message;
use App\Models\Recording;
use App\Models\User;
use App\Policies\CommentPolicy;
use App\Policies\Concerns\BanCheck;
use App\Policies\GuestPolicy;
use App\Policies\MessagePolicy;
use App\Policies\RecordingPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    use BanCheck;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Guest::class => GuestPolicy::class,
        User::class => UserPolicy::class,
        Message::class => MessagePolicy::class,
        Recording::class => RecordingPolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        /**
         * Vapor File Uploads (Allows Guest Uploads).
         */
        Gate::define('uploadFiles', function (?User $user) {
            return $this->checkBan($user);
        });

        //Passport::routes();
    }
}
