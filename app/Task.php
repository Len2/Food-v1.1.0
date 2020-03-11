<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Traits\HasRoles;

class Task extends Model
{
    use HasRoles;
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
