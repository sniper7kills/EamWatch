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
                $user = factory(\App\Models\User::class)->create();
            } else {
                $user = factory(\App\Models\Guest::class)->create();
            }
            $message = factory(\App\Models\Message::class)->make();
            $message->user = $user;
            $message->save();
            for ($c = 0; $c < 5; $c++) {
                $comment = factory(\App\Models\Comment::class)->make();
                if ($c % 2 == 0) {
                    $subUser = factory(\App\Models\User::class)->create();
                } else {
                    $subUser = factory(\App\Models\Guest::class)->create();
                }
                $comment->user = $subUser;
                $message->comments()->save($comment);
            }
        }
    }
}
