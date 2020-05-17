<?php


namespace App\Storages;


interface IStorage
{
    /**
     * @return array
     */
    public function get();

    /**
     * @param $id
     * @return object|null
     */
    public function find($id);
}
