<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $table = 'support';

    protected $fillable = [
        'id_user', 'id_project', 'title', 'description'
    ];

    public static function findSupportMessage($id_project, $id_support_message)
    {
        return self::where('id', '=', $id_support_message)->
                     where('id_project', '=', $id_project)->
                     orderBy('id', 'desc')->
                     firstOrFail();
    }

    public static function findSupportMessages($id_project)
    {
        return self::where('id_project', '=', $id_project)->
                     orderBy('id', 'desc')->
                     get();
    }
}
