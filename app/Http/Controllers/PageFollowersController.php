<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageFollower\CreatePageFollowerRequest;
use App\Http\Requests\PageFollower\UpdatePageFollowerRequest;
use App\Http\Resources\PageFollowerResource;
use Illuminate\Http\Request;
use App\PageFollowers;

class PageFollowersController extends Controller
{
    public function index()
    {
        return PageFollowerResource::collection(PageFollowers::paginate());
    }


    public function store(CreatePageFollowerRequest $request)
    {
        $pageFollower = PageFollowers::create($request->all());
        return new PageFollowerResource($pageFollower);
    }


    public function show($id)
    {
        $page_follower = PageFollowers::findOrFail($id);
        return new PageFollowerResource($page_follower);
    }


    public function update(UpdatePageFollowerRequest $request, $id)
    {
        $pageFollower = PageFollowers::findOrFail($id);
        $data = $request->only([
            'page_id', 'user_id',
        ]);

        $pageFollower->update($data);
        return new PageFollowerResource($pageFollower);

    }


    public function destroy($id)
    {
        $page_follower = PageFollowers::findOrFail($id);
        $page_follower->delete();

        return new PageFollowerResource($page_follower);
    }
}
