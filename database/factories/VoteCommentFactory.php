<?php

namespace Database\Factories;

use App\Models\VoteComment;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class VoteCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VoteComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment_id' => Comment::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'vote' => [-1, 1][array_rand([-1, 1])],
            'created_at' => $this->faker->dateTimeBetween('-31 days','now'),
        ];
    }
}
