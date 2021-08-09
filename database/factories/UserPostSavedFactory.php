<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\UserPostSaved;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserPostSavedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserPostSaved::class;

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
            'created_at' => $this->faker->dateTimeBetween('-31 days','now'),
        ];
    }
}
