<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectSettings;
use App\Http\Requests\ProjectSettingsRequest;

class ProjectSettingsController extends Controller
{
    protected function responseWithResult($result)
    {
        if($result == ProjectSettings::PERMISSION_DENIED_RESULT)
        {
            return $this->responsePermissionDenied();
        }
        return response()->json(['message' => 'patched']);
    }

    /**
     * http://site.local/api/v1/projects/{id_project}/settings?access={access}
     *
     * @param ProjectSettingsRequest $request
     * @param $id_project
     * @return \Illuminate\Http\JsonResponse
     */
    public function settingsAccess(ProjectSettingsRequest $request, $id_project)
    {
        $projectSettings = new ProjectSettings(
            Auth()->user(),
            Project::findOrFail($id_project)
        );

        return $this->responseWithResult(
            $projectSettings->setAccess($request->input('access_type'))
        );
    }
}
