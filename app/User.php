<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasRoles;

    protected $table = 'users';
    protected $fillable = [
        'firstName', 'lastName', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function page()
    {
        return $this->hasOne('App\Page');
    }

    public function address(){
        return $this->hasMany('App\Address');
    }





//    public function role()
//    {
//        return $this->belongsToMany(Role::class, 'role_user');
//    }

    /*
    public function userRoles(){
        return $this->hasMany('App\UserRole');
    }
    */

//    public function reservation(){
//        return $this->hasMany('App\Reservation');
//    }
//
    public function orders(){
        return $this->hasMany(Order::class);
    }
//
//    public function invoice(){
//        return $this->hasMany('App\Invoice');
//    }
//
//    public function pageFollowers(){
//        return $this->hasMany('App\PageFollowers');
//    }
//
//    public function galleryImages(){
//        return $this->hasMany('App\GalleryImage');
//    }

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
