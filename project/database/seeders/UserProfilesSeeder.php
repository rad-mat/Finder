<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * @var User $seededUser
         */
        $seededUser = DB::table('users')->select(['id'])->where('email', 'john.doe@gmail.com')->first();
        $seededUserId = $seededUser->id;
        if ($seededUserId) {
            DB::table('user_profiles')->insert([
                'name' => 'Jan Paweł',
                'surname' => 'Drugi',
                'favourite_number' => 2137,
                'favourite_function' => 'printf',
                'points' => 2,
                'solved_riddles' => "1,3,",
                'description' => "Lubię chleb i pociągi i moją mamę Magdę też lubię i masło orzechowe.",
                'sex' => 'Mężczyzna',
                'user_id' => $seededUserId
            ]);
        }
        /**
         * @var User $seededUser
         */
        $seededUser = DB::table('users')->select(['id'])->where('email', 'tim.doe@gmail.com')->first();
        $seededUserId = $seededUser->id;
        if ($seededUserId) {
            DB::table('user_profiles')->insert([
                'name' => 'Patrick',
                'surname' => 'Bateman',
                'favourite_number' => 102,
                'favourite_function' => "Euler's function",
                'points' => 10,
                'league' => 2,
                'solved_riddles' => "1,2,3,4,5,6,7,8,9,10",
                'description' => "Gorący matematyk z twojej okolicy ;)",
                'sex' => 'Mężczyzna',
                'user_id' => $seededUserId
            ]);
        }
        /**
         * @var User $seededUser
         */
        $seededUser = DB::table('users')->select(['id'])->where('email', 'elonora.doe@gmail.com')->first();
        $seededUserId = $seededUser->id;
        if ($seededUserId) {
            DB::table('user_profiles')->insert([
                'name' => 'Anna',
                'surname' => 'Jagiellonka',
                'favourite_number' => 1586,
                'favourite_function' => "Funkcja dzeta Riemanna",
                'points' => 14,
                'league' => 3,
                'solved_riddles' => "1,2,3,4,5,6,7,8,9,10,11,12,13,14",
                'description' => "Błyskotliwa, szczególnie interesuję się analizą funkcjonalną",
                'sex' => 'Kobieta',
                'user_id' => $seededUserId
            ]);
        }
        /**
         * @var User $seededUser
         */
        $seededUser = DB::table('users')->select(['id'])->where('email', 'anne.doe@gmail.com')->first();
        $seededUserId = $seededUser->id;
        if ($seededUserId) {
            DB::table('user_profiles')->insert([
                'name' => 'Obelix',
                'surname' => 'Gal',
                'favourite_number' => 12,
                'favourite_function' => 'getDzik()',
                'points' => 0,
                'solved_riddles' => "",
                'description' => "Gdy byłem mały, wpadłem do kociołka z magicznym napojem. Lubię nosić menhiry, dziki i bić Rzymian. Jeśli dobrze to rozegrasz, pokażę Ci Idefixa.",
                'sex' => 'Mężczyzna',
                'user_id' => $seededUserId
            ]);
        }
    }
}
