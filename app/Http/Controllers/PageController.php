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

class PageController extends Controller
{
    public function index()
    {
        return PageResource::collection(Page::get());
    }


    public function store(CreatePageRequest $request)
    {
        try{
            $page =new Page;
            $user = Auth::user();

            $page->avatar = $request->avatar;
            $page->name =$request->name;
            $page->url =  Str::slug($request->url);
            $page->description =$request->description;
            $page->work_start =$request->work_start;
            $page->work_end =$request->work_end;

            $user->page()->save($page);
            return new PageResource($page);
        }catch(Exception $e){
            return response()->json(array('error' =>Auth::user()->name."You can add only one restaurant"));
        }
    }


    public function show(Page $page)
    {
        return new PageResource($page);
    }


    public function update(UpdatePageRequest $request, Page $page)
    {
        $data = $request->only([
            'name', 'description', 'workingTime', 'phoneNumber', 'address_id'
        ]);

        $page->update($data);

        return new PageResource($page);
    }


    public function destroy(Page $page)
    {
        $page->delete();
        return response()->json(null,200);
    }        
}

