<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageRole extends Model
{
    protected $table = 'page_roles';
    public $timestamps = false;
    protected $guarded = [];

    public function pageUsers()
    {
        return $this->hasMany(PageUser::class);
    }
}
