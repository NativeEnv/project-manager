<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'task';

    protected $fillable = [
        'id_user', 'id_project', 'title', 'description', 'price', 'deadline'
    ];
}
