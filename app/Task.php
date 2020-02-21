<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $timestamps=false;
    protected $fillable=
    [
        'task_list_id',
        'status',
        'description',
        'start_date',
        'end_date',
        'notify_email',
        'attachment',
    ];

    public function taskList()
    {
        return $this->belongsTo(TaskList::class);
    }
}
