<?php

namespace Core;

abstract class AbstractModel
{

    private $table;

    private $dba = null;

    /**
     * Return database connection
     *
     * @param string $database
     * @return void
     */
    protected function getDb(string $database = null)
    {
        if (!isset($this->dba)) {
            //Create connection
        }

        return $this->dba; 
    }

    public static function all()
    {
        // Get all
    }

    public static function where(string $where)
    {

    }

    public function find(string $id)
    {
        $idField = $this->table;
        echo '<pre>';
        var_dump($idField);
        die('end');
        
        return $string;
    }

    public static function create(array $data)
    {
        // create by array data
    }
}
