<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageFollowers extends Model
{
    protected $table = 'page_followers';
    protected $fillable =
    [
        'page_id',
        'user_id',
    ];

    protected $guarded = ['id'];
    public $timestamps = false;

    public function page(){
        return $this->belongsTo('App\Page');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }

}
