<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
    }
}
