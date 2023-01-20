<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        DB::table('users')->insert([
            'name' => 'Tim Doe',
            'email' => 'tim.doe@gmail.com',
            'password' => bcrypt('tim-secret'),
        ]);

        DB::table('users')->insert([
            'name' => 'Elenora Doe',
            'email' => 'elonora.doe@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        DB::table('users')->insert([
            'name' => 'Anne Doe',
            'email' => 'anne.doe@gmail.com',
            'password' => bcrypt('anne'),
        ]);
    }
}
