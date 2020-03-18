<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Traits\HasRoles;

class Task extends Model
{
    use HasRoles;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function taskList()
    {
        return $this->belongsTo(TaskList::class);
    }
}
