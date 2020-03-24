<?php

namespace App\Http\Controllers;

use App\Http\Requests\Page\CreatePageRequest;
use App\Http\Requests\Page\UpdatePageRequest;
use App\Http\Resources\PageResource;
use Illuminate\Http\Request;
use App\Page;

class PageController extends Controller
{
    public function index()
    {
        return PageResource::collection(Page::paginate());
    }


    public function store(CreatePageRequest $request)
    {
        $page = Page::create($request->all());
        return new PageResource($page);
    }


    public function show(Page $page)
    {
        return new PageResource($page);
    }


    public function update(UpdatePageRequest $request, Page $page)
    {
        $data = $request->only([
            'name', 'description', 'work_time', 'phone_number', 'address_id'
        ]);

        $page->update($data);

        return new PageResource($page);
    }


    public function destroy(Page $page)
    {
        $page->delete();
        return response()->json(null,200);
    }
}

