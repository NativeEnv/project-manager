<?php


namespace App\Storages;


interface IStorage
{
    /**
     * @return array
     */
    public function all();

    /**
     * @param $id
     * @return object|null
     */
    public function find($id);
}
