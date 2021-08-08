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
        Vote::factory(20)->create();

        // \App\Models\User::factory(10)->create();
    }
}
