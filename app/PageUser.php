<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageUser extends Model
{
    protected $table = 'page_users';
    protected $fillable =
    [
        'user_role_id',
        'page_role_id',
        'page_id',
    ];

    protected $guarded = ['id'];
    public $timestamps = false;

    public function pageRoles(){
        return $this->BelongsTo('App\PageRole');
    }

    public function page(){
        return $this->BelongsTo('App\Page');
    }

    public function userRole(){
        return $this->BelongsTo('App\UserRole');
    }

}
