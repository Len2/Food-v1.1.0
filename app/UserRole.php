<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_role';
    protected $fillable =
    [
        'user_id',
        'role_id',
    ];

    protected $guarded = ['id'];
    public $timestamps = false;

    public function user(){
        return $this->belongsTo('App\User');
    }   
    public function role(){
        return $this->belongsTo('App\Role');
    }   
}
