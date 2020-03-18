<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
