<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::paginate());
    }


    public function store(CreateCategoryRequest $request)
    {
        if ($request->hasFile('image')) {
            $imageName = $request->image->getClientOriginalName();

            $category = new Category();
            $category->name = $request->name;
            $category->image = $imageName;
            $category->save();
        } else {
            return response()->json("The category-image failed to be stored", 404);
        }

        return new CategoryResource($category);
    }


    public function show(Category $category)
    {
        return new CategoryResource($category);
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->only([
            'name', 'image'
        ]);

        if ($request->hasFile('image')) {
            $imageName = $request->image->getClientOriginalName();

            $category = new Category();
            $category->name = $request->name;
            $category->image = $imageName;
            $category->update();
        }

        $category->update($data);

        return new CategoryResource($category);
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return new CategoryResource($category);
    }
}
