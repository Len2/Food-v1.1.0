<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use Image;

class CategoryController extends Controller
{

    protected $path;
    function __construct()
    {
        $this->path = public_path('images/category/');
        $this->user = Auth::user();
    }

    public function index()
    {
        if (! Gate::allows('category-list')) {
            throw new AuthorizationException('You have not permission');
        }
        return CategoryResource::collection($this->user->page->categories);
    }


    public function store(CreateCategoryRequest $request)
    {

        $page= $this->user->page;
        $category =new Category;

        $image = $request->file('image');
        $category->name =$request->name;

        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path =$this->path.$filename;
        //->resize(468, 249)
        $category->image = $filename;

        $page->categories()->save($category);

        // $this->user->page()->save($category);
        Image::make($image->getRealPath())->save($path);
        return new CategoryResource($category);
    }


//    public function show(Category $category)
//    {
//        return new CategoryResource($category);
//    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        if ($request->hasFile('image')) {
            $oldfilename = $category->image;
            if (\File::exists($this->path.$oldfilename)) {
                unlink($this->path.$oldfilename);
            }
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(361, 237)->save($this->path.$filename);
            $image->image = $filename;
            $category->image = $filename;
        }

        $category->name =$request->name;
        $category->save();
        return new CategoryResource($category);

    }


    public function destroy(Category $category)
    {
        if (! Gate::allows('category-delete')) {
            throw new AuthorizationException('You have not permission');
        }

        if($this->user->page->id == $category->page_id){
            $page= $this->user->page;

            $page->categories()->whereId($category->id)->delete();
            $imagePath = $category->image;
            if (\File::exists($this->path.$imagePath)) {
                unlink($this->path.$imagePath);
            }
            return response()->json(null,200);
        }else{
            return response()->json(array("error"=>"you have not permission to access"),401);
        }
    }
}
