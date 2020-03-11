<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Providers\AuthServiceProvider;
use  JWTAuth;
use  App\User;



class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if(! $user= JWTAuth::parseToken()->authenticate()){
//            return response()->json(['meassage'=>'User not found'],404);
//        }
//        if (Auth::check()) {
//           echo Auth::user();
//        }else{
//            echo "Not login";
//        }

//        $user=Auth::user();
//        echo $user->can('edit articles');

//        if (! Auth::user()->can('tasks_manage')) {
//            return "Not permissions";
//        }
//
//

//        if (! Gate::allows('tasks_manage')) {
//            return abort(401);
//        }


        $task = Task::get();
        if(is_null($task)){
          return response()->json(["Error"=>"Task, not found"],404);
        }
        return response()->json(["data" => $task],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'task_list_id'      =>  'required',
            'status'            =>  'required',
            'description'       =>  'required',
            'start_date'        =>  'required',
            'end_date'          =>  'required',
            'notify_email'      =>  'required',
            'attachment'        =>  'required'
        ]);
    
        $task = Task::create($request->all());
        return response()->json(["data" => $task],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        if(is_null($task)){
           return response()->json(["Error"=>"Task, not found"],404);
       }
       return response()->json(["data" => $task],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        $validate = $request->validate(
        [
            'task_list_id'      =>  'regex:/^[0-9]+$/',
            'status'            =>  'string',
            'description'       =>  'string',
            'start_date'        =>  'string',
            'end_date'          =>  'string',
            'notify_email'      =>  'string',
            'attachment'        =>  'string',
        ]);

        if(is_null($task)){
             return response()->json(["Error"=>" not found"],404);
        }

        $task->update($request->all());
        return response()->json(["data" => $task],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task=Task::find($id);
        if(is_null($task)){
             return response()->json(["Error"=>" not found"],404);
        }
        
        $task->delete();
        return response()->json(null,200);
    }
}
