<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageUser extends Model
{
    protected $table = 'page_users';
    protected $guarded = [];

    public function userRole()
    {
        return $this->belongsTo(UserRole::class);
    }

    public function pageRole()
    {
        return $this->belongsTo(PageRole::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

}
