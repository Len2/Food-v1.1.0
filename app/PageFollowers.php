<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageFollowers extends Model
{
    protected $table = 'page_followers';
    public $timestamps = false;
    protected $guarded = [];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
