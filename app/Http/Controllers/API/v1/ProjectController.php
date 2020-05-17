<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\ProjectCreateRequest;

class ProjectController extends Controller
{
    /**
     * http://site.local/api/v1/projects
     * @method POST
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(ProjectCreateRequest $request)
    {
        $project = Project::create($request->input());

        return response()->json(['project' => $project], 201);
    }

    /**
     * http://site.local/api/v1/projects/{id}
     * @method GET
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);

        if(!$project->issetGeneralAccess() && auth()->user() === null)
        {
            return $this->responseUnauthorized();
        }

        if(!$project->issetGeneralAccess() && !$project->userHasAccess(auth()->user()))
        {
            return $this->responsePermissionDenied();
        }

        return response()->json(['project' => $project]);
    }
}
