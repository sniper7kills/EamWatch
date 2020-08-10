<?php

namespace App\Jobs\Concerns;

use App\Models\RelayProvider;
use App\Jobs\DiscordWebHook;
use App\Jobs\TwitterHandler;

trait ProviderDecider {

    public function sendToProviders(string $action)
    {
        $relayProviders = RelayProvider::where('enabled', true)->get();
        foreach($relayProviders as $provider)
        {
            if($provider->type == "Discord") {
                dispatch(new DiscordWebHook($provider, $this->message, $action));
            }

            if($provider->type == "Twitter") {
                dispatch(new TwitterHandler($provider, $this->message, $action));
            }
        }
    }
}