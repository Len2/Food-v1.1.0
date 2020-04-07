<?php

namespace App\Http\Controllers\Api\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserPage;
//use App\Page;
//use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;

class UserPageController extends Controller
{

    public function __construct()
    {
        $this->user = Auth::user();
        $this->middleware('assign.guard:user_pages');
    }
    public function index()
    {
    // if (! Gate::allows('driver-list')) {
    //new AuthorizationException('You have not permission for update role');
    // }
        $page = $this->user->page;
        return response()->json(["data" => $page->userPages],200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:user_pages',
            'password' => 'required',
            'roles' => 'required'
        ]);

        $page = $this->user->page;
        $userPage = new UserPage([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        $page->userPages()->save($userPage);
        $userPage->assignRole($request->input('roles'));

        $credentials = request(['email', 'password']);
        $token = auth('user_pages')->attempt($credentials);
        return response()->json([
            'token' => $token,
            'message' => 'Successfully created user!'

        ], 200);
    }

//    public function show($id)
//    {
//        //
//    }

//    public function edit($id)
//    {
//        //
//    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:user_pages',
            'password' => 'required',
            'roles' => 'required'
        ]);

        $page = $this->user->page;
        $userPage = UserPage::find($id);

        $userPage->firstName = $request->input('firstName');
        $userPage->lastName= $request->input('lastName');
        $userPage->email = $request->input('email');
        $userPage->password = bcrypt($request->input('password'));

        $page->userPages()->save($userPage);
        $userPage->assignRole($request->input('roles'));

        $credentials = request(['email', 'password']);
        $token = auth('user_pages')->attempt($credentials);
        return response()->json([
            'token' => $token,
            'message' => 'Successfully edit user!'

        ], 200);
    }

    public function destroy($id)
    {
        if(Auth::user()->page_id == $this->user->page->id ){
            UserPage::find($id)->delete();
            return response()->json(null,200);
        }else{
            return response()->json(array("error"=>"you have not permission to access"),401);
        }
    }
}
