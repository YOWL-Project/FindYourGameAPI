<?php

namespace Database\Factories;

use App\Models\VotePost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class VotePostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VotePost::class;

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
            'vote' => [-1, 1][array_rand([-1, 1])],
            'created_at' => $this->faker->dateTimeBetween('-31 days','now'),
        ];
    }
}
