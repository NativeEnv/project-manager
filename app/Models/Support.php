<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $table = 'support';

    protected $fillable = [
        'id_user', 'id_project', 'title', 'description'
    ];
}
