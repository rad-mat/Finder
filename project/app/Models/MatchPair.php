<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MatchPair extends Model
{
    use HasFactory;
    protected $table = 'match_history';

    /**
     * @return HasOne<User>
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id');
    }
    /**
     * @return HasOne<User>
     */
    public function match(): HasOne
    {
        return $this->hasOne(User::class, 'match_id');
    }
}
