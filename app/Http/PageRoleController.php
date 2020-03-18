<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRole\CreatePageRoleRequest;
use App\Http\Requests\PageRole\UpdatePageRoleRequest;
use App\Http\Resources\PageRoleResource;
use Illuminate\Http\Request;
use App\PageRole;

class PageRoleController extends Controller
{
    public function index()
    {
        return PageRoleResource::collection(PageRole::paginate());
    }


    public function store(CreatePageRoleRequest $request)
    {
        $pageRole = PageRole::create($request->all());
        return new PageRoleResource($pageRole);
    }


    public function show($id)
    {
        $page_role = PageRole::findOrFail($id);
        return new PageRoleResource($page_role);
    }


    public function update(UpdatePageRoleRequest $request, $id)
    {
        $page_role = PageRole::findOrFail($id);
        $data = $request->only([
            'title',
        ]);

        $page_role->update($data);
        return new PageRoleResource($page_role);
    }


    public function destroy($id)
    {
        $page_role = PageRole::findOrFail($id);
        $page_role->delete();

        return new PageRoleResource($page_role);
    }
}
