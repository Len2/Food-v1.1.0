<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Table;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables=Table::get();
        if(is_null($tables)){
          return response()->json("No Restaurants",404);
        }
        return response()->json($tables,200);
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
            //'number'=>'required|regex:/^[0-9]+$/|unique:tables',
            'number'=>'required|regex:/^[0-9]+$/',
            'nr_chairs'=>'regex:/^[0-9]+$/',
            'status'=>'required|in:available,busy',
            'type_of_table'=>'required|in:food,drink',
            'page_id'=>'required|regex:/^[0-9]+$/'
            //'pages_id'=>'required|exists:pages,id|regex:/^[0-9]+$/'
        ]);
       $table = Table::create($request->all());
        return response()->json($table,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $tables=Table::find($id);
        if(is_null($tables)){
            return response()->json("Not found",404);
        }
        $validate = $request->validate(
        [
            //'number'=>'regex:/^[0-9]+$/|unique:tables',
            'number'=>'regex:/^[0-9]+$/',
            'nr_chairs'=>'regex:/^[0-9]+$/',
            'status'=>'in:available,busy',
            'type_of_table'=>'in:food,drink',
            'page_id'=>'regex:/^[0-9]+$/'
            //'pages_id'=>'exists:pages,id|regex:/^[0-9]+$/'
        ]);
        $tables->update($request->all());
        return response()->json($tables,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Table::find($id);

        if(is_null($table)){
             return response()->json("Not found",404);
        }
        $table->delete();
        return response()->json(null,200);
    }
}
