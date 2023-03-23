<?php

namespace App\Providers;

use App\Models\Message;
use App\Observers\MessageObserver;
use App\Rules\MessageValidForTypeValidator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(125);
        Message::observe(MessageObserver::class);

        Validator::resolver(function ($translator, $data, $rules, $messages) {
            return new MessageValidForTypeValidator($translator, $data, $rules, $messages);
        });
    }
}
