<?php

namespace App\Http\Controllers;

use App\Http\Requests\Album\CreateAlbumRequest;
use App\Http\Requests\Album\UpdateAlbumRequest;
use App\Http\Resources\AlbumResource;
use Illuminate\Http\Request;
use App\Album;

class AlbumController extends Controller
{
    public function index()
    {
        return AlbumResource::collection(Album::paginate());
    }


    public function store(CreateAlbumRequest $request)
    {
        $album = Album::create($request->all());
        return new AlbumResource($album);
    }


    public function show(Album $album)
    {
        return new AlbumResource($album);
    }


    public function update(UpdateAlbumRequest $request, Album $album)
    {
        $data = $request->only([
            'name'
        ]);

        $album->update($data);
        return new AlbumResource($album);
    }


    public function destroy(Album $album)
    {
        $album->delete();
        return new AlbumResource($album);
    }
}
