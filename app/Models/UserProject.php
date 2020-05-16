<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Project;

class UserProject extends Model
{
    protected $table = 'user_project';

    /**
     * @param User $user
     * @param \App\Models\Project $project
     * @return bool
     */
    public static function userIsParticipant(User $user, Project $project) : bool
    {
        return self::where('id_user', '=', $user->id)->where('id_project', '=', $project->id)->count() > 0;
    }
}
