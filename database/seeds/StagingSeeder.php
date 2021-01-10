<?php

use Illuminate\Database\Seeder;

class StagingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 0; $x < 100; $x++) {
            if ($x % 2 == 0) {
                $user = \App\Models\User::factory()->create();
            } else {
                $user = \App\Models\Guest::factory()->create();
            }
            $message = \App\Models\Message::factory()->make();
            $message->user = $user;
            $message->save();
            for ($c = 0; $c < 5; $c++) {
                $comment = \App\Models\Comment::factory()->make();
                if ($c % 2 == 0) {
                    $subUser = \App\Models\User::factory()->create();
                } else {
                    $subUser = \App\Models\Guest::factory()->create();
                }
                $comment->user = $subUser;
                $message->comments()->save($comment);
            }
        }
    }
}
