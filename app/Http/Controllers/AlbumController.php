<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::get();
        if(is_null($albums))
        {
            return response()->json("Not found",404);
        }
        return response()->json($albums,200);
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
        $albums = $request->validate([
            'name'=>'required|string|unique:albums'
        ]);

        $albums = Album::create($request->all());

        if(is_null($albums)){
            return response()->json("The Album failed to be builded",404);
        }
        return response()->json($albums, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = Album::find($id);
        if(is_null($album)){
            return reponse()->json();
        }
        return response()->json($album,201);
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
        $albums = Album::find($id);
        $validate = $request->validate([
            'name'=>'string|unique:albums'
        ]);
        
        if(is_null($albums))
        {
            return response()->json("Album ".$id.", not found");
        }

        $albums->update($request->all());
        return response()->json($albums,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $albums = Album::find($id);
        if(is_null($Album))
        {
            return response()->json("Album ".$id."not found", 404);
        }
        $albums->delete();
        return response()->json(null,200);
    }
}
