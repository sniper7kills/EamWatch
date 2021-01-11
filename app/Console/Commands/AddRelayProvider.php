<?php

namespace App\Console\Commands;

use App\Models\RelayProvider;
use App\Models\User;
use Illuminate\Console\Command;

class AddRelayProvider extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'relay:provider:create 
                                {name : name of the provider}
                                {type : Twitter or Discord}
                                {user_id : ID of the user who "owns" the relay}
                                {details : json encoded details of the provider}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new relay provider';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $provider = new RelayProvider();
        $provider->name = $this->argument('name');
        $provider->type = $this->argument('type');
        $provider->details = $this->argument('details');
        $provider->enabled = true;
        $provider->user()->associate(User::find($this->argument('user_id')));

        $provider->save();

        return 0;
    }
}
