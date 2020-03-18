<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskList\CreateTaskListRequest;
use App\Http\Requests\TaskList\UpdateTaskListRequest;
use App\Http\Resources\TaskListResource;
use Illuminate\Http\Request;
use App\TaskList;

class TaskListController extends Controller
{
    public function index()
    {
        return TaskListResource::collection(TaskList::paginate());
    }


    public function store(CreateTaskListRequest $request)
    {
        $tasklist = TaskList::create($request->all());
        return new TaskListResource($tasklist);
    }


    public function show($id)
    {
        $tasklist = TaskList::findOrFail($id);
        return new TaskListResource($tasklist);
    }


    public function update(UpdateTaskListRequest $request, $id)
    {
        $tasklist = TaskList::findOrFail($id);

        $data = $request->only([
            'name', 'page_id'
        ]);

        $tasklist->update($data);
        return new TaskListResource($tasklist);
    }


    public function destroy($id)
    {
        $tasklist = TaskList::findOrFail($id);
        $tasklist->delete();

        return new TaskListResource($tasklist);
    }
}
