<?php

namespace App\Http\Controllers;

use App\Http\Requests\Page\CreatePageRequest;
use App\Http\Requests\Page\UpdatePageRequest;
use App\Http\Resources\PageResource;
use Illuminate\Http\Request;
use App\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;
use Image;
class PageController extends Controller
{

    protected $path;
    function __construct()
    {
        $this->path = public_path('images/pageLogo/');
    }

    public function index()
    {
        $user=Auth::user();
        if($user->hasRole('Admin')){
            return PageResource::collection(Page::get());
        }else if($user->hasRole('page-owner')){
            $page=$user->page;
            return PageResource::collection(array($page));
        }
    }

    public function store(CreatePageRequest $request)
    {
        try{
            $page =new Page;
            $user = Auth::user();

            $avatar = $request->file('avatar');
            $page->name =$request->name;
            $page->url =  Str::slug($request->url);
            $page->description =$request->description;
            $page->work_start =$request->work_start;
            $page->work_end =$request->work_end;

            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $path = public_path($this->path.$filename);
            //->resize(468, 249)
            $page->avatar = $filename;
            $user->page()->save($page);
            Image::make($avatar->getRealPath())->save($path);

            return new PageResource($page);
        }catch(Exception $e){
            return response()->json(array('error' =>Auth::user()->name."You can add only one restaurant"));
        }
    }

//    public function show(Page $page)
//    {
//        return new PageResource($page);
//    }

    public function update(UpdatePageRequest $request, Page $page)
    {
        $user = Auth::user();
        if ($request->hasFile('avatar')) {
            $oldfilename = $page->avatar;
            if (\File::exists($this->path.$oldfilename)) {
                unlink($this->path.$oldfilename);
            }
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(361, 237)->save($this->path.$filename);
            $page->avatar = $filename;
        }

        $page->avatar = $filename;
        $page->name =$request->name;
        $page->url =  Str::slug($request->url);
        $page->description =$request->description;
        $page->work_start =$request->work_start;
        $page->work_end =$request->work_end;

        $user->page()->save($page);
        return new PageResource($page);
    }

    public function destroy(Page $page)
    {
        $imagePath = $page->avatar;
        if (\File::exists($this->path.$imagePath)) {
            unlink($this->path.$imagePath);
        }

        $page->delete();
        return response()->json(null,200);
    }        
}

