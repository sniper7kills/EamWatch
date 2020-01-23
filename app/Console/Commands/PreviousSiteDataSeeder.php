<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use League\Csv\Reader;

class PreviousSiteDataSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:import {offset}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Data From Previous Site Versions';

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
     * @return mixed
     */
    public function handle()
    {
        $user = \App\Models\User::firstOrCreate(
            ['name' => 'Data Migration User'],
            [
                'email' => 'dmu@eam.watch',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => Str::random(10)
            ]
        );
        $csvData = file_get_contents('https://eam-watch.s3.amazonaws.com/CSV/eams.csv');
        $csv = Reader::createFromString($csvData);
        $csv->setDelimiter('%');
        $offset = $this->argument('offset');
        $csv->setOffset($offset);
        $results = $csv->fetch();
        $recordNumber = $offset;
        foreach ($results as $row) {
                $message = new \App\Models\Message();
                $message->time = $row[2];
                $message->type = $row[4];
                $message->receiver = ($row[6] == "NULL")? null: $row[6];
                $message->message = $row[8];
                $message->sender = $row[10];
                $message->user = $user;
                $message->save();
                print("Record: ".$recordNumber." EAM_ID: ".$row[0]." Message ID: ".$message->id."\n");
                $recordNumber++;
        }
        $user->banned = true;
        $user->save();

        return null;
    }
}
