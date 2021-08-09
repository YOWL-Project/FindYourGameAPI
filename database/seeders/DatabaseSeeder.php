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
        \App\Models\Topic::factory(35)->create();
        \App\Models\VoteTopic::factory(100)->create();
        \App\Models\Visit::factory(300)->create();
    }
}
