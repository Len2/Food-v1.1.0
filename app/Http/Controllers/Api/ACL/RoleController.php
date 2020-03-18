<?php

namespace App\Http\Controllers\Api\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('role-list')) {
            throw new AuthorizationException('You have not permission for show roles');
        }

        $roles = Role::get();
        if(is_null($roles)){
            return response()->json(["Error"=>"Role, not found"],404);
        }
        return response()->json(["data" => $roles],200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create()
//    {
//
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('role-create')) {
            throw new AuthorizationException('You have not permission for add role');
        }
        $request->validate([
            'name'      =>  'required',
            'permission'=> 'required',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return response()->json(["data" => $role],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function show($id)
//    {
//        //
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('role-edit')) {
            throw new AuthorizationException('You have not permission for update role');
        }
        $role = Role::find($id);
        $request->validate(
            [
                'name'            =>  'required',
                'permission' => 'required',
            ]
        );
        if(is_null($role)){
            return response()->json(["Error"=>"Role not found"],404);
        }

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));
        return response()->json(["data" => $this->index()],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('role-delete')) {
            throw new AuthorizationException('You have not permission for delete role');
        }
        $role = Role::find($id);
        $role->delete();
        return response()->json(null,200);
    }
}
