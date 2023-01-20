<?php

namespace Database\Seeders;

use App\Models\MatchPair;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatchHistorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user1 = User::firstWhere('email', 'anne.doe@gmail.com');
        $user2 = User::firstWhere('email', 'john.doe@gmail.com');
        $user3 = User::firstWhere('email', 'tim.doe@gmail.com');
        if ($user1 instanceof User && $user2 instanceof User && $user3 instanceof User) {
            DB::table('match_history')->insert([
                'user_id' => $user3->id,
                'match_id'=> $user2->id,
                'accepted'=> 1
            ]);
            DB::table('match_history')->insert([
                'user_id' => $user1->id,
                'match_id'=> $user2->id,
                'accepted'=> 0
            ]);
        }
    }
}
