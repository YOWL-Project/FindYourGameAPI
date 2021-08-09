<?php

namespace Database\Factories;

use App\Models\VoteTopic;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoteTopicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VoteTopic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'topic_id' => Topic::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'vote' => [-1, 1][array_rand([-1, 1])],
            'created_at' => $this->faker->dateTimeBetween('-31 days','now'),
        ];
    }
}
