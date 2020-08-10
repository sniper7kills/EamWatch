<?php

namespace App\Jobs;

use App\Jobs\Concerns\MessageManipulation;
use App\Models\Message;
use App\Models\RelayProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DiscordWebHook implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, MessageManipulation;

    protected $provider;

    protected $message;

    protected $action = 'create';

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
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->action == 'create')
            $this->createPost();
    }

    private function createPost()
    {
        $providerDetails = json_decode($this->provider->details,true);

        $response = Http::post($providerDetails['url'], 
        [
            "wait" => true,
            "username" => "Eam.Watch",
            "tts" => false,
            "embeds" => [
                [
                    "title" => "New " . $this->message->type . " Submitted",
                    "type" => "rich",
                    "description" => $this->getFormattedMessage(),
                    "url" => "https://www.eam.watch/view/".$this->message->id,
                    "timestamp" => $this->message->time,
                    "color" => hexdec( "3366ff" ),
                    "author" => $this->getAuthorArray(),
                    "fields" => $this->getEmbedFields(),
                ]
            ]
        ]);
    }

    private function getAuthorArray()
    {
        $user = $this->message->userable;
        if($user->getMorphClass() == User::class)
        {
            return [
                "name" => $user->name,
                "url" => "https://www.eam.watch/user/".$user->id
            ];
        }

        return [
            "name" => "Guest ".$user->id,
            "url" => "https://www.eam.watch/guest/".$user->id
        ];
    }

    private function getEmbedFields()
    {
        $fields = [
            [
                "name" => "ID",
                "value" => $this->message->id,
                "inline" => false
            ],
            [
                "name" => "Type",
                "value" => $this->message->type,
                "inline" => false
            ],
            [
                "name" => "Sender",
                "value" => $this->message->sender,
                "inline" => false
            ],
            [
                "name" => "Time",
                "value" => $this->message->time,
                "inline" => false
            ],
        ];

        if(!is_null($this->message->receiver)){
            $fields[0][] = [
                "name" => "Receiver",
                "value" => $this->message->receiver,
                "inline" => false
            ];
        }

        return $fields;
    }
}
