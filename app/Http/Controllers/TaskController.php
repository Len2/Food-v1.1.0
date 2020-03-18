<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;
use App\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Providers\AuthServiceProvider;
use Illuminate\Auth\Access\Response;
use  JWTAuth;
use  App\User;

use Illuminate\Auth\Access\AuthorizationException;


class TaskController extends Controller
{

//    function __construct()
//    {
//         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
//         $this->middleware('permission:user-create', ['only' => ['create','store']]);
//         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
//         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
//    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        if (! Gate::allows('user-create')) {
            throw new AuthorizationException('You have not permission');
        }
        return TaskResource::collection(Task::get());
    }


    public function store(CreateTaskRequest $request)
    {
        $task = Task::create( request()->except(['token']));
        return new TaskResource($task);
    }


    public function show(Task $task)
    {
        return new TaskResource($task);
    }


    public function update(UpdateTaskRequest $request, Task $task)
    {
        $data = $request->only([
            'task_list_id', 'status', 'description', 'start_date', 'end_date', 'notify_email', 'attachment',
        ]);

        $task->update($data);
        return new TaskResource($data);
    }


    public function destroy(Task $task)
    {
        $task->delete();
        return new TaskResource($task);
    }
}
