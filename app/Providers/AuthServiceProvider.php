<?php

namespace App\Providers;

use App\Models\Guest;
use App\Models\Message;
use App\Models\Recording;
use App\Models\User;
use App\Policies\Concerns\BanCheck;
use App\Policies\MessagePolicy;
use App\Policies\RecordingPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    use BanCheck;
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        null => UserPolicy::class,
        User::class => UserPolicy::class,
        Message::class => MessagePolicy::class,
        Recording::class => RecordingPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Vapor File Uploads (Allows Guest Uploads)
         */
        Gate::define('uploadFiles', function (?User $user) {
            return $this->checkBan($user);
        });

        /**
         * Ability to view Telescope
         */
        Gate::define('viewTelescope', function (User $user) {
            return in_array($user->email, [
                'taylor@laravel.com',
            ]);
        });
        $this->registerPolicies();
    }
}
