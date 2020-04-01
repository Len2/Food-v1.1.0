<?php

namespace App\Http\Controllers\Api\ACL;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use  Hash;
use Spatie\Permission\Models\Role;
use DB;
use Illuminate\Auth\Access\AuthorizationException;
class UserController extends Controller
{
    public function index()
    {
        if (! Gate::allows('user-list')) {
            throw new AuthorizationException('You have not permission for show users');
        }
        $users = User::get();
        if(is_null($users)){
            return response()->json(["Error"=>"User, not found"],404);
        }
        return response()->json(["data" => $users],200);
    }

//    public function create()
//    {
//        //
//    }

    public function store(Request $request)
    {
        if (! Gate::allows('user-create')) {
            throw new AuthorizationException('You have not permission for add user');
        }
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return response()->json(["data" => $user],201);
      //  echo "Test post method";


    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        if (! Gate::allows('user-edit')) {
            throw new AuthorizationException('You have not permission for update user');
        }
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));
        return response()->json(["data" => $user],200);
    }

    public function destroy($id)
    {
        if (! Gate::allows('user-delete')) {
            throw new AuthorizationException('You have not permission for delete user');
        }
        User::find($id)->delete();
        return response()->json(null,200);
    }


//    public function getIDPageOwner(){
//        $admins = User::role('page-owner')->get();
//        return $admins;
//    }
//Extra methods
    public function registerPageOwner(Request $request){
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            //'roles' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole('page-owner');
        return response()->json(["data" => $user],201);
    }
}
