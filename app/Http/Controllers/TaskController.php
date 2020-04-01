<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use Exception;
use App\Task;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class TaskController extends Controller
{

    function __construct()
    {
        $this->user = Auth::user();
    }

    public function index()
    {
        if ($this->user->hasRole('Admin')) {
            return TaskResource::collection(Task::all());
        } else if ($this->user->hasRole('page-owner')) {
            $tasks = $this->user->page->taskLists()
                ->with('tasks')
                ->get()
                ->pluck('tasks')
                ->collapse()
                ->unique('id')
                ->values();
            return TaskResource::collection($tasks);
        }
    }


    public function store(CreateTaskRequest $request)
    {
        try {
            if ($this->user->hasRole('page-owner')) {
                $task = Task::create($request->all());
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
        $data = $request->only([
            'task_list_id', 'status', 'description', 'start_date', 'end_date', 'notify_email', 'attachment',
        ]);

        try {
            $taskList = $this->user->page->taskLists()
                ->where('id', $task->task_list_id)->first();

            if ($taskList) {
                $task->update($data);
                return new TaskResource($data);
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
                return response()->json(null, 200);
            } else {
                throw new Exception('Error! You cannot delete this task!');
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
