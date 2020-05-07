<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class UserPage extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasRoles;

    protected $guard = 'userPage';

    protected $table = 'user_pages';
    protected $fillable = [
        'firstName', 'lastName', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function page(){
        return $this->belongsTo(Page::class);
    }

    // JWT Functions
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return[];
    }
}
