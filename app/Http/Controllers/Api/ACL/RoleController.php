<?php

namespace App\Http\Controllers\Api\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\AuthorizationException;


use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{

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

    public function store(Request $request)
    {
        if (! Gate::allows('role-create')) {
            throw new AuthorizationException('You have not permission for add role');
        }
        $request->validate([
            'name'      =>  'required',
            'permission'=> 'required',
        ]);

        if($request->has('guard_name')){
            $reqRole = [
                'name' => $request->input('name'),
                'guard_name' => $request->input('guard_name')
            ];
        }else{
            $reqRole = [
                'name' => $request->input('name'),
                'guard_name' => "web"
            ];
        }

        $role = Role::create($reqRole);
        $role->syncPermissions($request->input('permission'));
        return response()->json(["data" => $role],201);
    }

//    public function storeWithGuard (Request $request){
//        $role = Role::create(['guard_name' => 'user_pages', 'name' => 'driver2']);
//    }

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
        if($request->has('guard_name')){
            $role->guard_name = $request->input('guard_name');
        }
        $role->save();

        $role->syncPermissions($request->input('permission'));
        return response()->json(["data" => $this->index()],200);
    }

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
