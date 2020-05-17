<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\UserProject;

/**
 * Class Project
 *
 * @property integer $id
 * @property integer $access
 * @property integer $has_support
 *
 * @package App\Models
 */
class Project extends Model
{
    /**
     * Project in work
     */
    const WORK_STATUS = 0;

    /**
     * Project is done
     */
    const DONE_STATUS = 1;

    /**
     * General access
     */
    const GENERAL_ACCESS = 0;

    /**
     * Accept access
     */
    const VERIFICATION_ACCESS = 1;

    protected $table = 'project';

    protected $fillable = [
        'title', 'description', 'id_user', 'access'
    ];

    public function hasSupport()
    {
        return $this->has_support;
    }

    /**
     * @return int
     */
    public function getAccess()
    {
        return $this->access;
    }

    public function issetGeneralAccess()
    {
        return $this->getAccess() == self::GENERAL_ACCESS;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function userHasAccess(User $user) : bool
    {
        if($this->access == self::GENERAL_ACCESS)
        {
            return true;
        }
        if($this->access == self::VERIFICATION_ACCESS)
        {
            return UserProject::userIsParticipant($user, $this);
        }

        return false;
    }

    public static function createProject(Array $data)
    {
        $project = self::create($data);

        if(isset($data['access']) && $data['access'] == self::VERIFICATION_ACCESS)
        {
            UserProject::create([
                'id_user' => $project->id_user,
                'id_project' => $project->id,
                'status' => UserProject::CREATOR_STATUS
            ]);
        }

        return $project;
    }

    public static function getAccessCodes()
    {
        return [self::GENERAL_ACCESS, self::VERIFICATION_ACCESS];
    }
}
