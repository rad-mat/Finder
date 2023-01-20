<?php

namespace Database\Seeders;

use App\Models\Riddle;
use Illuminate\Database\Seeder;

class RiddlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Riddle::create([
            'category' => 'geometria',
            'title' => 'Trójkąty w ośmiokącie',
            'question' => 'Ile istnieje nieprzystających trójkątów utworzonych przez wierzchołki ośmiokąta foremnego?',
            'answer' => 'N/A',
        ]);

        Riddle::create([
            'category' => 'cyfry i liczby',
            'title' => 'Za siedmioma cyframi',
            'question' => 'Jaka jest najmniejsza liczba całkowita dodatnia równa siedmiokrotności sumy jej cyfr?',
            'answer' => '21',
        ]);

        Riddle::create([
            'category' => 'ciągi',
            'title' => 'Jaki następny',
            'question' => 'Spójrz na ten ciąg numeryczny i spróbuj rozwikłać jego zasadę i odgadnąć kolejną liczbę: 2 5 8 14 23.',
            'answer' => 'N/A',
        ]);

        Riddle::create([
            'category' => 'cyfry i liczby',
            'title' => 'Dzielenie przez 5',
            'question' => 'Ile co najwyżej kolejnych liczb całkowitych może mieć tę własność, że suma cyfr każdej z nich nie jest podzielna przez 5?',
            'answer' => 8,
        ]);

        Riddle::create([
            'category' => 'cyfry i liczby',
            'title' => '26262626...',
            'question' => 'Rozważamy wszystkie liczby, które składają się z dokładnie 2022 cyfr 2 lub 6. Jaka jest ostatnia cyfra sumy tych liczb?',
            'answer' => 'N/A',
        ]);

        for ($i = 0; $i < 13; $i = $i + 1) {
            Riddle::create([
                'category' => 'geometria',
                'title' => 'Lorem ipsum',
                'question' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'answer' => 'N/A',
            ]);
        }
    }
}
