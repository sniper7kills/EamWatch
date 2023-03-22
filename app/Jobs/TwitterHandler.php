<?php

namespace App\Jobs;

use App\Jobs\Concerns\MessageManipulation;
use App\Models\Message;
use App\Models\Relay;
use App\Models\RelayProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use TwitterAPIExchange;

class TwitterHandler implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, MessageManipulation;

    protected $provider;

    protected $message;

    protected $action = 'create';

    private $settings;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(RelayProvider $provider, Message $message, string $action)
    {
        $this->provider = $provider;
        $this->message = $message;
        $this->action = $action;

        $providerDetails = json_decode($this->provider->details, true);
        $this->settings = [
            'oauth_access_token' => $providerDetails['accessToken'],
            'oauth_access_token_secret' => $providerDetails['accessTokenSecret'],
            'consumer_key' => $providerDetails['consumerKey'],
            'consumer_secret' => $providerDetails['consumerSecret'],
        ];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->action == 'create') {
            $this->createPost();
        }

        if ($this->action == 'delete') {
            $this->deletePosts();
        }
    }

    private function deletePosts()
    {
        $relays = $this->provider->relays()->where('message_id', $this->message->id)->get();
        foreach ($relays as $relay) {
            $savedResponse = json_decode($relay->response, true);
            $tweetID = $savedResponse['id_str'];

            $url = 'https://api.twitter.com/1.1/statuses/destroy/'.$tweetID.'.json';
            $requestMethod = 'POST';
            $postfields = [
                'id' => $savedResponse['id'],
            ];
            $twitter = new TwitterAPIExchange($this->settings);
            $response = $twitter->buildOauth($url, $requestMethod)
                ->setPostfields($postfields)
                ->performRequest();

            $relay->delete();
        }
    }

    private function createPost()
    {
        $url = 'https://api.twitter.com/1.1/statuses/update.json';
        $requestMethod = 'POST';
        $postfields = [
            'status' => $this->getMessage(),
            'skip_status' => '1',
        ];
        $twitter = new TwitterAPIExchange($this->settings);
        $response = $twitter->buildOauth($url, $requestMethod)
            ->setPostfields($postfields)
            ->performRequest();

        $relay = new Relay();
        $relay->response = $response;
        $relay->relayProvider()->associate($this->provider);
        $relay->message()->associate($this->message);
        $relay->save();
    }

    private function getMessage()
    {
        $message = $this->message->time.' ['.$this->message->type.'    ';
        if (! is_null($this->message->receiver) && $this->message->receiver != '') {
            $message .= 'FOR '.$this->message->receiver.': ';
        }
        $message .= $this->getFormattedMessage();
        $message .= '    '.$this->message->sender.']';

        if (strlen($message) <= 280) {
            return $message;
        }

        return $this->message->time.' - New '.$this->message->type.' Submitted - https://www.eam.watch/view/'.$this->message->id;
    }
}
