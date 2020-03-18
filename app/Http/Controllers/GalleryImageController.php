<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryImage\CreateGalleryImageRequest;
use App\Http\Requests\GalleryImage\UpdateGalleryImageRequest;
use App\Http\Resources\GalleryImageResource;
use Illuminate\Http\Request;

use App\GalleryImage;

class GalleryImageController extends Controller
{
    public function index()
    {
        return GalleryImageResource::collection(GalleryImage::paginate());
    }


    public function store(CreateGalleryImageRequest $request)
    {
        if ($request->hasFile('photo')) {
            $imageName = $request->photo->getClientOriginalName();

            $galleryImage = new GalleryImage;
            $galleryImage->page_id = $request->page_id;
            $galleryImage->user_id = $request->user_id;
            $galleryImage->album_id = $request->album_id;
            $galleryImage->photo = $imageName;
            $galleryImage->save();
        } else {
            return response()->json("The Gallery-Image failed to be stored", 404);
        }

        return new GalleryImageResource($galleryImage);
    }


    public function show($id)
    {
        $galleryImage = GalleryImage::findOrFail($id);
        return new GalleryImageResource($galleryImage);
    }


    public function update(UpdateGalleryImageRequest $request, $id)
    {
        $galleryImage = GalleryImage::findOrFail($id);

        $data = $request->only([
            'page_id', 'user_id', 'album_id', 'photo',
        ]);

        if ($request->hasFile('photo')) {
            $imageName = $request->photo->getClientOriginalName();
            $galleryImage->page_id = $request->page_id;
            $galleryImage->user_id = $request->user_id;
            $galleryImage->album_id = $request->album_id;
            $galleryImage->photo = $imageName;
            $galleryImage->update();
        }

        $galleryImage->update($data);
        return new GalleryImageResource($galleryImage);
    }


    public function destroy($id)
    {
        $galleryImage = GalleryImage::findOrFail($id);
        $galleryImage->delete();

        return new GalleryImageResource($galleryImage);
    }
}
