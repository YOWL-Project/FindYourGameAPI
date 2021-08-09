<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\UserTopicSaved;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserTopicSavedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserTopicSaved::class;

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
            'created_at' => $this->faker->dateTimeBetween('-31 days','now'),
        ];
    }
}
