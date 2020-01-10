<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Recording;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Recording::class, function (Faker $faker) {
    return [
        'broadcasted_at' => \Carbon\Carbon::now(),
        'frequency' => $faker->numberBetween(),
        'automated' => false,
        'link' => $faker->url,
    ];
});
