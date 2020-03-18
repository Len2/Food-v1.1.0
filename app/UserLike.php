<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLike extends Model
{
    protected $table = 'user_likes';
    public $timestamps = false;
    protected $guarded = [];

    public function userRole()
    {
        return $this->belongsTo(UserRole::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
