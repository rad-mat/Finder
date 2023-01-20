<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RiddlesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(UserProfilesSeeder::class);
        $this->call(MatchHistorySeeder::class);
    }
}
