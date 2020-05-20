<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UserCreateRequest;

class UserController extends Controller
{
    /**
     * http://site.local/api/v1/users
     * @method POST
     *
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(UserCreateRequest $request)
    {
        return response()->json(User::createUser($request->input()), 201);
    }

    /**
     * http://site.local/api/v1/users/{id}
     * @method GET
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return User::findOrFail($id);
    }
}
