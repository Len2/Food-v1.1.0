<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PageCategory;

class PageCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagesCategory=PageCategory::get();
        if(is_null($pagesCategory)){
          return response()->json("No data registered",404);
        }
        return response()->json($pagesCategory,200);
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
            //'pages_id'=>'required|regex:/^[0-9]+$/|exists:pages,id|',
            //'category_id'=>'required|regex:/^[0-9]+$/|exists:categories,id|',
            'page_id'=>'required|regex:/^[0-9]+$/',
            'category_id'=>'required|regex:/^[0-9]+$/',
            'displayName'=>'required|string'
        ]);
        $pagescategory=PageCategory::create($request->all());
        return response()->json($pagescategory,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pagescategory=PageCategory::find($id);
        if(is_null($pagescategory)){
           return response()->json("Not found",404);
        }
       return response()->json($pagescategory,200);
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
        $pagesCategory=PageCategory::find($id);
        if(is_null($pagesCategory)){
           return response()->json("Not found",404);
        }

        $validator = $request->validate([
          //'page_id'=>'regex:/^[0-9]+$/|exists:pages,id',
          //'category_id'=>'regex:/^[0-9]+$/|exists:categories,id',
          'page_id'=>'regex:/^[0-9]+$/',
          'category_id'=>'regex:/^[0-9]+$/',
          'displayName'=>'string'
        ]);

        $pagesCategory->update($request->all());
        return response()->json($pagesCategory,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pageCategory = PageCategory::find($id);

        if(is_null($pageCategory)){
             return response()->json("Not found",404);
      	}
        $pageCategory->delete();
        return response()->json(null,200);
    }
}
