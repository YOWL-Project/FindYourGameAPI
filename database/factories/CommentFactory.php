<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

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
            'content' => $this->faker->text,
            'created_at' => $this->faker->dateTimeBetween('-31 days','now'),
        ];
    }
}
