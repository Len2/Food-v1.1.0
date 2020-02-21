<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        if(is_null($products)){
          return response()->json("No products",404);
        }
        return response()->json($products,201);
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
        $validate = $request->validate(
            [
            'name'=>'required',
            'description'=>'required|string',
            'price'=>'required|regex:/^\-?[0-9]+(?:\.[0-9]+)?$/',
            //'category_id'=>'required|regex:/^[0-9,-]*$/|exists:pages_categories,id',  
            //'page_id'=>'required|regex:/^[0-9]+$/|exists:pages,id',
            'category_id'=>'required|regex:/^[0-9,-]*$/',  
            'page_id'=>'required|regex:/^[0-9]+$/',
            'image'=>'required|image',
            ]
        );

        
        if($request->hasFile('image'))
        {
            $imageName = $request->image->getClientOriginalName();

            $product = new Product;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->page_id = $request->page_id;
            $product->image = $imageName;
            $product->save();
        } else {
            return response()->json("The Product failed to be builded",404);
        }

        return response()->json($product,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if(is_null($product)){
           return response()->json("Not found",404);
       }
       return response()->json($product,200);
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
        $product = Product::find($id);
        $validate = $request->validate(
            [
            'name'=>'required',
            'description'=>'required|string',
            'price'=>'required|regex:/^\-?[0-9]+(?:\.[0-9]+)?$/',
            //'category_id'=>'required|regex:/^[0-9,-]*$/|exists:pages_categories,id',  
            //'page_id'=>'required|regex:/^[0-9]+$/|exists:pages,id',
            'category_id'=>'required|regex:/^[0-9,-]*$/',  
            'page_id'=>'required|regex:/^[0-9]+$/',
            'image'=>'required|image',
            ]
        );
        if($request->hasFile('image'))
        {
            $imageName = $request->image->getClientOriginalName();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->page_id = $request->page_id;
            $product->image = $imageName;
            $product->update();
        } else {
            return response()->json(["Error"=>"The Product failed to be builded"],404);
        }
        return response()->json($product,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if(is_null($product)){
             return response()->json("Not found",404);
        }
         $product->delete();
         return response()->json(null,200);
    }
}
