<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use App\Http\Requests\TaskCreateRequest;

class TaskController extends Controller
{
    /**
     * @param $id_project
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id_project)
    {
        $project = Project::findOrFail($id_project);

        return $this->jsonResponse([
            'tasks' => $project->getTasks()->all()
        ]);
    }

    /**
     * http://site.local/api/v1/projects/{id_project}/tasks
     * @method POST
     *
     * @param Request $request
     * @param $id_project
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(TaskCreateRequest $request, $id_project)
    {
        $request->merge([
            'id_project' => $id_project,
            'id_user' => auth()->user()->id
        ]);

        return $this->responseCreated([
            'task' => Task::create($request->input())
        ]);
    }

    /**
     * http://site.local/api/v1/projects/{id_project}/tasks/{$id_task}
     *
     * @param $id_project
     * @param null $id_task
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id_project, $id_task)
    {
        $project = Project::findOrFail($id_project);

        if(!$project->userHasAccess(auth()->user())) $this->responsePermissionDenied();

        if(!$task = $project->getTasks()->find($id_task))
        {
            return $this->responseNotFound();
        }

        return $this->jsonResponse([
            'task' => $task
        ]);
    }
}
