<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::get();
        if(is_null($pages)){
          return response()->json("No Pages/Restaurants",404);
        }
        return response()->json($pages,200);
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
            'description'=>'required',
            'workingTime'=>'required|',
            'phoneNumber'=>'required|min:6',
            'address_id'=>'required|regex:/^[0-9,-]*$/'
            //'address_id'=>'required|regex:/^[0-9,-]*$/|exists:addresses,id'
            ]);

        $pages=Page::create($request->all());
        return response()->json($pages,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::find($id);
        if(is_null($page)){
           return response()->json("Pages/Restaurants".$id.", not found",404);
        }
        return response()->json($page,200);
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
        $pages=Page::find($id);
      
        $validate = $request->validate(
        [
        'name'=>'string',
        'description'=>'string',
        'workingTime'=>'string',
        'phoneNumber'=>'string|min:6',
        'address_id'=>'regex:/^[0-9]+$/'
        ]);
        
        if(is_null($pages)){
          return response()->json("Not found",404);
        }
        $pages->update($request->all());
        return response()->json($pages,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);

        if(is_null($page)){
             return response()->json("Not found",404);
        }
        $page->delete();
        return response()->json(null,200);
    }
}
