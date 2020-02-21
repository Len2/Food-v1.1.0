<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    public $timestamps=false;
    protected $fillable=
    [
        'name',
        'page_id',
    ];

    public function task(){
    	return $this->hasMany('App\Task');
    }

    public function page(){
    	return $this->belongsTo('App\Page');
    }
}
