<?php

namespace Core\Database;

class DataBateConnection
{
    public function createConnection(string $database = null)
    {
        $arrConfig = $this->getDatabaseConfig();
    }

    private function getDataBaseConfig() : array
    {
        $config = parse_ini_file("../db_credentials.ini");
        echo '<pre>';
        var_dump($config);
        die('end');
        
        return $config;
    }
}
