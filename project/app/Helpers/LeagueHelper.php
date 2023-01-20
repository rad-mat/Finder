<?php

namespace App\Helpers;

class LeagueHelper
{
    public static function getLeague(int $league): string
    {
        return match ($league) {
            0 => "Podrzędny dodawacz",
            1 => "Regularny matematyk",
            2 => "Brat Numeryk",
            3 => "Adept różniczkowania",
            4 => "Mistrz całek",
            default => "Nieskalany matematycznym wysiłkiem",
        };
    }
}
