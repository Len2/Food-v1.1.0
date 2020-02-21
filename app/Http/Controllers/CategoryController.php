<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::get();
        if(is_null($categories)){
          return response()->json("No categories registered",404);
        }
        return response()->json($categories,200);
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
        $validator = $request->validate([
            'name'=>'required|unique:categories',
            'image'=>'required| mimes:jpeg,jpg,png '
        ]);

        if($request->hasFile('image'))
        {
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = $request->file('image')->storeAs('public/images',$fileNameToStore);

            $categories = new Category;
            if($request->hasFile('image')){
                $categories->name=$request->input('name');
                $categories->image = $fileNameToStore;
            }
            $categories->save();
            return response()->json($categories,200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::find($id);
         if(is_null($categories)){
            return response()->json("Not found",404);
        }
        return response()->json($categories,200);
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
        $categories = Category::find($id);
        $validate = $request->validate(
            [
            'name' => 'string',
            'image' => 'image',
            ]
        );
        if($request->hasFile('image'))
        {
            $imageName = $request->image->getClientOriginalName();
            $categories->name = $request->name;
            $categories->image = $imageName;
            $categories->update();
        } else {
            return response()->json(["Error"=>"The Category".$id.", failed to be builded"],404);
        }
        return response()->json($categories,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories=Category::find($id);
        if(is_null($categories)){
            return response()->json("Not found",404);
        }
        $categories->delete();
        return response()->json(null,204);
    }
}
