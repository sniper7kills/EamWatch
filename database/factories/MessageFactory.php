<?php

namespace Database\Factories;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

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

class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'message' => $this->faker->word(),
            'sender' => $this->faker->word(),
            'receiver' => $this->faker->word(),
            'broadcast_ts' => Carbon::now(),
            'type' => 'BACKEND',
            'visible' => true,
        ];
    }
}
