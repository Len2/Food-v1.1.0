<?php

namespace App\Http\Controllers;

use App\Http\Requests\Page\CreatePageRequest;
use App\Http\Requests\Page\UpdatePageRequest;
use App\Http\Resources\PageResource;
//use App\User;
//use Illuminate\Http\Request;
use App\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;
use Image;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;
class PageController extends Controller
{

    protected $path;
    function __construct()
    {
        if(Auth::guard("user_pages")->user()== ''){
            $this->user=Auth::guard("api")->user();
        }else{
            $this->user=Auth::guard("user_pages")->user();
        }
        $this->path = public_path('images/pageLogo/');

    }

    public function index()
    {
        if (!Gate::allows('page-list')) {
            throw new AuthorizationException('You have not permission');
        }

        if($this->user->hasRole('Admin')){
            return PageResource::collection(Page::all());
        }else if($this->user->hasRole('page-owner')){
            $page=$this->user->page;
            return PageResource::collection(array($page));
        }
    }

    public function store(CreatePageRequest $request)
    {
        try{
            $page =new Page;

            $avatar = $request->file('avatar');
            $page->name =$request->name;
            $page->url =  Str::slug($request->url);
            $page->description =$request->description;
            $page->work_start =$request->work_start;
            $page->work_end =$request->work_end;

            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $path =$this->path.$filename;
            //->resize(468, 249)
            $page->avatar = $filename;
            $this->user->page()->save($page);
            Image::make($avatar->getRealPath())->save($path);

            return new PageResource($page);
        }catch(Exception $e){
            return response()->json(array('error' =>Auth::user()->name."You can add only one restaurant",'message' => $e));
        }

    }

//    public function show(Page $page)
//    {
//        return new PageResource($page);
//    }

    public function update(UpdatePageRequest $request, Page $page)
    {
        if ($request->hasFile('avatar')) {
            $oldfilename = $page->avatar;
            if (\File::exists($this->path.$oldfilename)) {
                unlink($this->path.$oldfilename);
            }
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(361, 237)->save($this->path.$filename);
            $page->avatar = $filename;
            $page->avatar = $filename;
        }

        $page->name =$request->name;
        $page->url =  Str::slug($request->url);
        $page->description =$request->description;
        $page->work_start =$request->work_start;
        $page->work_end =$request->work_end;

        $this->user->page()->save($page);
        return new PageResource($page);
    }

    public function destroy(Page $page)
    {
        if (! Gate::allows('page-delete')) {
            throw new AuthorizationException('You have not permission');
        }
        if($this->user->id == $page->user_id){
            $this->user->page()->delete();
            $imagePath = $page->avatar;
            if (\File::exists($this->path.$imagePath)) {
                unlink($this->path.$imagePath);
            }
            return response()->json(null,200);
        }else{
            return response()->json(array("error"=>"you have not permission to access"),401);
        }
    }        
}

