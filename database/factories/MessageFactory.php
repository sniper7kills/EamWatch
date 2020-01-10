<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Message;
use Faker\Generator as Faker;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Message::class, function (Faker $faker) {
    return [
        'message' => $faker->word,
        'sender' => $faker->word,
        'receiver' => $faker->word,
        'broadcast_ts' => Carbon::now(),
        'type' => 'BACKEND',
        'visible' => true,
    ];
});
