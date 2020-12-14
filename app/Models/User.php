<?php

namespace App\Models;

use App\Models\Sign;
use App\Models\Comment;
use App\Models\Petition;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /* ADMIN and VERIFIED Users constants */
    /*
    const VERIFIED_USER = 'false';
    const UNVERIFIED_USER = 'true';
    const ADMIN_USER = 'true';
    const Regular_USER = 'false';
    */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
    * User Relations
    */
    public function sings()
    {
        return $this->hasMany(Sign::class, 'sign_id');
    }

    public function petitions()
    {
        return $this->hasMany(Petition::class, 'petition_id');
    }

    public function photos()
    {
        return $this->hasMany(Comment::class, 'photo_id');
    }

    //TODO: Implement the isVerified and isAdmin methods
}
