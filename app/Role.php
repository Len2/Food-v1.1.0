<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $fillable =
    [
        'title',
    ];

    protected $guarded = ['id'];
    public $timestamps = false;

    public function userRoles(){
        return $this->hasMany('App\UserRole');
    }

}
