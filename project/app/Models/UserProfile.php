<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    public function user(): object
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'name',
        'user_id',
        'surname',
        'favourite_number',
        'favourite_function',
        'description',
        'sex'
    ];
}
