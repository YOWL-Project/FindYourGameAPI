<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vote;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(40)->create();
        \App\Models\Topic::factory(30)->create();
        \App\Models\Comment::factory(60)->create();
        \App\Models\VoteTopic::factory(100)->create();
        \App\Models\VotePost::factory(100)->create();
        \App\Models\VoteComment::factory(100)->create();
        \App\Models\UserPostSaved::factory(100)->create();
        \App\Models\UserTopicSaved::factory(100)->create();
        \App\Models\Visit::factory(300)->create();
    }
}
