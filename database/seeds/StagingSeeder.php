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
        for($x = 0; $x < 100; $x++)
        {
            $user = factory(\App\Models\User::class)->create();
            $message = factory(\App\Models\Message::class)->make();
            $message->user = $user;
            $message->save();
            for($c = 0; $c < 5; $c++)
            {
                $comment = factory(\App\Models\Comment::class)->make();
                $comment->user = factory(\App\Models\User::class)->create();
                $message->comments()->save($comment);
            }
        }
    }
}
