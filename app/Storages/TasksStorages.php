<?php

namespace App\Storages;

use App\Storages\IStorage;

use App\Models\Task;

/**
 * Class TasksStorages
 * @package App\Storages
 */
class TasksStorages implements IStorage
{
    /**
     * @var array[Task]
     */
    private $_tasks;

    /**
     * TasksStorages constructor.
     *
     * @param $id_project
     */
    public function __construct($id_project)
    {
        $this->_tasks = Task::where('id_project', $id_project)->get();
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->_tasks;
    }

    /**
     * @param $id
     * @return object|null
     */
    public function find($id)
    {
        foreach($this->_tasks as $task)
        {
            if($task->id == $id) return $task;
        }
        return null;
    }
}
