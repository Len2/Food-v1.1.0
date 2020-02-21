<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\GalleryImage;

class GalleryImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleryImage = GalleryImage::get();
        if(is_null($galleryImage))
        {
            return response()->json("Not found",404);
        }
        return response()->json($galleryImage, 200);
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
            'page_id' => 'required|regex:/^[0-9]+$/',
            'user_id' => 'required|regex:/^[0-9]+$/',
            'album_id' => 'required|regex:/^[0-9]+$/',
            'photo' => 'required|image',
            ]
        );

        
        if($request->hasFile('photo'))
        {
            $imageName = $request->photo->getClientOriginalName();

            $galleryImage = new GalleryImage;
            $galleryImage->page_id = $request->page_id;
            $galleryImage->user_id = $request->user_id;
            $galleryImage->album_id = $request->album_id;
            $galleryImage->photo = $imageName;
            $galleryImage->save();
        } else {
            return response()->json("The Gallery-Image failed to be builded",404);
        }

        return response()->json($galleryImage,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $galleryImage = GalleryImage::find($id);
        if(is_null($galleryImage)){
            return response()->json(["Error"=>"Get failed! Page role ".$id.",not found"], 404);
        }
        return response()->json($galleryImage,200);
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
    public function update(Request $request,  $id)
    {
        $galleryImage = GalleryImage::find($id);
        $validate = $request->validate(
            [
            'page_id' => 'regex:/^[0-9]+$/',
            'user_id' => 'regex:/^[0-9]+$/',
            'album_id' => 'regex:/^[0-9]+$/',
            'photo' => 'image',
            ]
        );
        if($request->hasFile('photo'))
        {
            $imageName = $request->photo->getClientOriginalName();
            $galleryImage->page_id = $request->page_id;
            $galleryImage->user_id = $request->user_id;
            $galleryImage->album_id = $request->album_id;
            $galleryImage->photo = $imageName;
            $galleryImage->update();
        } else {
            return response()->json(["Error"=>"The Gallery-Image failed to be builded"],404);
        }
        return response()->json($galleryImage,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $galleryImage = GalleryImage::find($id);
        if(is_null($galleryImage))
        {
            return response()->json(["Error"=>"Gallery Image ".$id.", not found"],404);
        }
        $galleryImage->delete();
        return response()->json($galleryImage,200);
    }
}
