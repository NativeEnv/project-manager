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
     * http://site.local/api/v1/projects/{id_project}/tasks
     * @method POST
     *
     * @param Request $request
     * @param $id_project
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(TaskCreateRequest $request, $id_project)
    {
        $request->merge(['id_project' => $id_project]);

        return $this->responseCreated(
            'task',
            Task::create($request->input())
        );
    }

    /**
     * Show all tasks:
     *  http://site.local/api/v1/projects/{id_project}/tasks
     *
     * Show the task:
     *  http://site.local/api/v1/projects/{id_project}/tasks/{id_task}
     *
     * @param $id_project
     * @param null $id_task
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id_project, $id_task = null)
    {
        $project = Project::findOrFail($id_project);

        if(!$project->issetGeneralAccess() && auth()->user() === null)
        {
            return $this->responseUnauthorized();
        }

        if(!$project->issetGeneralAccess() && !$project->userHasAccess(auth()->user()))
        {
            return $this->responsePermissionDenied();
        }

        if($id_task)
        {
            return $this->responseSuccess('task', $project->getTasks()->find($id_task));
        }
        return $this->responseSuccess('tasks', $project->getTasks()->get());
    }
}
