<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\TaskList;
use Exception;
use App\Task;
use Illuminate\Support\Facades\Auth;
use Image;

class TaskController extends Controller
{

    protected $path;

    function __construct()
    {
        if(Auth::guard("user_pages")->user()== ''){
            $this->user=Auth::guard("api")->user();
        }else{
            $this->user=Auth::guard("user_pages")->user();
        }
        $this->path = public_path('attachments/tasks/');
    }

    public function index()
    {
        if ($this->user->hasRole('Admin')) {
            return TaskResource::collection(Task::all());
        } else if ($this->user->hasRole('page-owner')) {
             $task=TaskList::with('tasks')->get();
            return TaskResource::collection($task);
        }
    }


    public function store(CreateTaskRequest $request)
    {
        try {
            if ($this->user->hasRole('page-owner')) {

                $task = new Task();

                $task->task_list_id = $request->task_list_id;
                $task->status = $request->status;
                $task->description = $request->description;
                $task->start_date = $request->start_date;
                $task->end_date = $request->end_date;
                $task->notify_email = $request->notify_email;

                $attachment =  $request->file('attachment');
                $filename = time() . '.' . $attachment->getClientOriginalExtension();
                $path = $this->path.$filename;
                Image::make($attachment->getRealPath())->save($path);
                $task->attachment = $filename;
                $task->save();

                return new TaskResource($task);
            } else {
                throw new Exception('Error! You have to be a page owner to create a task!');
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }


//    public function show(Task $task)
//    {
//        return new TaskResource($task);
//    }


    public function update(UpdateTaskRequest $request, Task $task)
    {
        try {
            $taskList = $this->user->page->taskLists()
                ->where('id', $task->task_list_id)->first();

            if ($taskList) {
                if ($request->hasFile('attachment')) {
                    $oldFilename = $task->attachment;
                    if (\File::exists($this->path.$oldFilename)) {
                        unlink($this->path.$oldFilename);
                    }
                    $attachment = $request->file('attachment');
                    $filename = time() . '.' . $attachment->getClientOriginalExtension();
                    Image::make($attachment->getRealPath())->save($this->path.$filename);
                    $attachment->attachment = $filename;
                    $task->attachment = $filename;
                }

                $task->task_list_id = $request->task_list_id;
                $task->status = $request->status;
                $task->description = $request->description;
                $task->start_date = $request->start_date;
                $task->end_date = $request->end_date;
                $task->notify_email = $request->notify_email;
                $task->save();

                return new TaskResource($task);
            } else {
                throw new Exception('Error! You cannot edit this task!');
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Task $task)
    {
        try {
            $taskList = $this->user->page->taskLists()
                ->where('id', $task->task_list_id)->first();

            if ($taskList) {
                $task->delete();
                $attachment = $task->attachment;
                if (\File::exists($this->path.$attachment)) {
                    unlink($this->path.$attachment);
                }
                return response()->json(null, 200);
            } else {
                throw new Exception('Error! You cannot delete this task!');
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
