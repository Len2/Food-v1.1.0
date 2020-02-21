<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'firstName', 'lastName', 'email', 'password','address_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationships with User Table
    public function userRoles(){
        return $this->hasMany('App\UserRole');
    } 

    public function reservation(){
        return $this->hasMany('App\Reservation');
    }   

    public function order(){
        return $this->hasMany('App\Order');
    } 

    public function invoice(){
        return $this->hasMany('App\Invoice');
    } 
    
    public function pageFollowers(){
        return $this->hasMany('App\PageFollowers');
    }  
    
    public function galleryImages(){
        return $this->hasMany('App\GalleryImage');
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
