<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Project;

/**
 * Class UserProject
 *
 * @property integer $status
 *
 * @package App\Models
 */
class UserProject extends Model
{
    const CREATOR_STATUS = 2;
    const MODERATOR_STATUS = 1;
    const USER_STATUS = 0;

    protected $table = 'user_project';

    protected $fillable = [
        'id_user', 'id_project', 'status'
    ];

    public static function findUserProject(User $user, Project $project)
    {
        return self::where('id_user', '=', $user->id)->
                     where('id_project', '=', $project->id)->
                     first();
    }
    
    /**
     * @param User $user
     * @param \App\Models\Project $project
     * @return bool
     */
    public static function userIsParticipant(User $user, Project $project) : bool
    {
        return self::findUserProject($user, $project) != null;
    }
}
