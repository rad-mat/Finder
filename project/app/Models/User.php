<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property mixed $profile
 * @property int $id
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasOne<UserProfile>
     */
    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }
    /**
     * @return HasMany<MatchPair>
     */
    public function matches(): HasMany
    {
        return $this->hasMany(MatchPair::class, 'user_id');
    }
    /**
     * @return HasMany<MatchPair>
     */
    public function matchedBy(): HasMany
    {
        return $this->hasMany(MatchPair::class, 'match_id');
    }
    public function imagePath(): string
    {
        return "assets/profileImages/image_" . $this->id . ".jpg";
    }
}
