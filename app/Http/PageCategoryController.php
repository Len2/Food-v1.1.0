<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageCategory\CreatePageCategoryRequest;
use App\Http\Requests\PageCategory\UpdatePageCategoryRequest;
use App\Http\Resources\PageCategoryResource;
use Illuminate\Http\Request;
use App\PageCategory;

class PageCategoryController extends Controller
{
    public function index()
    {
        return PageCategoryResource::collection(PageCategory::paginate());
    }


    public function store(CreatePageCategoryRequest $request)
    {
        $pageCategories = PageCategory::create($request->all());
        return new PageCategoryResource($pageCategories);
    }


    public function show($id)
    {
        $pageCategory = PageCategory::findOrFail($id);

        return new PageCategoryResource($pageCategory);
    }


    public function update(UpdatePageCategoryRequest $request, $id) // nuk po bon*
    {
        $pageCategory = PageCategory::findOrFail($id);

        $data = $request->only([
            'page_id', 'category_id', 'displayName'
        ]);

        $pageCategory->update($data);
        return new PageCategoryResource($data);
    }


    public function destroy($id)
    {
        $pageCategory = PageCategory::findOrFail($id);
        $pageCategory->delete();

        return new PageCategoryResource($pageCategory);
    }
}
