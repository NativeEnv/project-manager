<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Support;

class SupportController extends Controller
{
    /**
     * http://site.local/api/v1/projects/{id_project}/supports
     * @method GET
     *
     * @param $id_project
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id_project)
    {
        $project = Project::findOrFail($id_project);
        if(!$project->userHasAccess(auth()->user())) return $this->responsePermissionDenied();
        if(!$project->hasSupport())
        {
            return response()->json(['message' => 'No support for this project'],403);
        }

        $messages = Support::findSupportMessages($id_project);
        if($messages->isEmpty())
        {
            return $this->responseNotFound();
        }

        return $messages;
    }

    /**
     * http://site.local/api/v1/projects/{id_project}/supports
     * @method POST
     *
     * @param Request $request
     * @param $id_project
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request, $id_project)
    {
        $project = Project::findOrFail($id_project);

        if(!$project->userHasAccess(auth()->user())) return $this->responsePermissionDenied();
        if(!$project->hasSupport())
        {
            return response()->json(['message' => 'No support for this project'],403);
        }

        $request->merge([
            'id_user'    => auth()->user()->id,
            'id_project' => $id_project
        ]);

        return response()->json(Support::create($request->input()), 201);
    }

    /**
     * http://site.local/api/v1/projects/{id_project}/supports/{id_support_message}
     * @method GET
     *
     * @param $id_project
     * @param $id_support_message
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id_project, $id_support_message)
    {
        $project = Project::findOrFail($id_project);
        if(!$project->userHasAccess(auth()->user())) return $this->responsePermissionDenied();
        if(!$project->hasSupport())
        {
            return response()->json(['message' => 'No support for this project'],403);
        }

        return Support::findSupportMessage($id_project, $id_support_message);
    }
}
