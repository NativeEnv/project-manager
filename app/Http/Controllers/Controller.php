<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param array $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse(Array $data, $code = 200)
    {
        return response()->json($data, $code);
    }

    /**
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return $this->jsonResponse([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseUnauthorized()
    {
        return $this->jsonResponse(['error' => 'Unauthorized'], 401);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responsePermissionDenied()
    {
        return $this->jsonResponse(['error' => 'Permission denied'], 403);
    }

    protected function responseNotFound()
    {
        return $this->jsonResponse(['message' => 'Not Found'], 404);
    }
}
