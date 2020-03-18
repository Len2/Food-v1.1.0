<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageUser\CreatePageUserRequest;
use App\Http\Requests\PageUser\UpdatePageUserRequest;
use App\Http\Resources\PageUserResource;
use Illuminate\Http\Request;
use App\PageUser;

class PageUserController extends Controller
{
    public function index()
    {
        return PageUserResource::collection(PageUser::paginate());
    }


    public function store(CreatePageUserRequest $request)
    {
        $pageUser = PageUser::create($request->all());
        return new PageUserResource($pageUser);
    }


    public function show($id)
    {
        $pageUser = PageUser::findOrFail($id);

        return new PageUserResource($pageUser);
    }


    public function update(UpdatePageUserRequest $request, $id)
    {
        $pageUser = PageUser::findOrFail($id);

        $data = $request->only([
            'user_role_id', 'page_role_id', 'page_id',
        ]);

        $pageUser->update($data);

        return new PageUserResource($pageUser);
    }


    public function destroy($id)
    {
        $pageUser = PageUser::find($id);
        $pageUser->delete();

        return new PageUserResource($pageUser);
    }
}
