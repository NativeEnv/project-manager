<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Models\Project;
use App\Models\UserProject;

class ProjectSettings extends Model
{
    const PERMISSION_DENIED_RESULT = 0;
    const SUCCESS_RESULT = 1;

    /**
     * Project for settings
     * @var Project
     */
    private $_project;

    /**
     * User who sets up the project
     * @var User
     */
    private $_user;

    /**
     * @var UserProject
     */
    private $_user_project;

    /**
     * @var array
     */
    private $rules = [
        'access' => [UserProject::CREATOR_STATUS]
    ];

    /**
     * ProjectSettings constructor.
     * @param User $user
     * @param Project $project
     * @param array $attributes
     */
    public function __construct(User $user, Project $project, array $attributes = [])
    {
        $this->_user = $user;
        $this->_project = $project;
        $this->_user_project = UserProject::findUserProject($user, $project);

        parent::__construct($attributes);
    }

    /**
     * @param $optionName
     * @return bool
     */
    public function userCanSetup($optionName) : bool
    {
        if(!isset($this->rules[$optionName])) return false;
        return in_array($this->_user_project->status, $this->rules[$optionName]);
    }

    /**
     * @param $value
     * @return int
     */
    public function setAccess($value)
    {
        if(!$this->userCanSetup('access')) return self::PERMISSION_DENIED_RESULT;

        $this->_project->access = $value;
        $this->_project->save();

        return self::SUCCESS_RESULT;
    }
}
