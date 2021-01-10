<?php

namespace App\Jobs\Concerns;

use App\Jobs\DiscordWebHook;
use App\Jobs\TwitterHandler;
use App\Models\RelayProvider;

trait ProviderDecider
{
    public function sendToProviders(string $action)
    {
        $relayProviders = RelayProvider::where('enabled', true)->get();
        foreach ($relayProviders as $provider) {
            if ($provider->type == 'Discord') {
                dispatch(new DiscordWebHook($provider, $this->message, $action));
            }

            if ($provider->type == 'Twitter') {
                dispatch(new TwitterHandler($provider, $this->message, $action));
            }
        }
    }
}
