<?php

namespace Database\Factories;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Topic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'game_id' => random_int(0,500),
            'user_id' => User::all()->random()->id,
            'title' => $this->faker->sentence(6),
            'created_at' => $this->faker->dateTimeBetween('-31 days','now'),
        ];
    }
}
