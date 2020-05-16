<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;

class AuthController extends Controller
{
    /**
     * http://site.local/api/v1/auth/login
     * @method POST
     *
     * @param UserLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(UserLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if(!$token = auth()->attempt($credentials))
        {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * http://site.local/api/v1/auth/identity
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function identity()
    {
        return response()->json(auth()->user());
    }

    /**
     * http://site.local/api/v1/auth/refresh
     * @method POST
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * http://site.local/api/v1/auth/logout
     * @method POST
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
