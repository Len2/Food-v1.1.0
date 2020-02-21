<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLike extends Model
{
    protected $table = 'user_likes';
    protected $fillable =
    [
        'role_user_id',
        'product_id',
    ];

    protected $guarded = ['id'];
    public $timestamps = false;
    
    public function userRoles()
    {
        return $this->belongsTo('App\UserRole');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
//KA JE ARDIT, JE HUP KREJT
