<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLike\CreateUserLikeRequest;
use App\Http\Requests\UserLike\UpdateUserLikeRequest;
use App\Http\Resources\UserLikeResource;
use Illuminate\Http\Request;
use App\UserLike;

class UserLikeController extends Controller
{
    public function index()
    {
        return UserLikeResource::collection(UserLike::paginate());
    }


    public function store(CreateUserLikeRequest $request)
    {
        $userLike = UserLike::create($request->all());
        return new UserLikeResource($userLike);
    }


    public function show($id)
    {
        $userLike = UserLike::findOrFail($id);
        return new UserLikeResource($userLike);
    }


    public function update(UpdateUserLikeRequest $request, $id)
    {
        $userLike = UserLike::findOrFail($id);
        $data = $request->only([
            'role_user_id', 'product_id',
        ]);

        $userLike->update($data);
        return new UserLikeResource($userLike);
    }


    public function destroy($id)
    {
        $userLike = UserLike::findOrFail($id);
        $userLike->delete();

        return new UserLikeResource($userLike);
    }
}
