<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageRole extends Model
{
    protected $table = 'page_roles';
    protected $fillable =
    [
        'title',
    ];

    protected $guarded = ['id'];
    public $timestamps = false;

    public function pageUsers(){
        return $this->hasMany('App\PageUser');
    }

}
