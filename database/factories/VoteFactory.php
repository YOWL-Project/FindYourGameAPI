<?php

namespace Database\Factories;

use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vote::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'vote_date' => $this->faker->unique()->dateTimeBetween('-31 days','now')->format('Y-m-d'),
            'votes_number' => $this->faker->numberBetween(200,2000),
        ];
    }
}
