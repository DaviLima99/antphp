
<?php

use App\Config\AppConfig;

$arrCredentials = parse_ini_file('../db_credentials.ini');

return [
    'databases' => [
        'default' => [
            'driver'    => AppConfig::DRIVER_MYSQL,
            'host'      => $arrCredentials['hostname'],
            'port'      => $arrCredentials['port'],
            'dbname'    => $arrCredentials['database'],
            'user'      => $arrCredentials['user'],
            'password'  => $arrCredentials['password']
        ],
        'testes' => [
            'driver'    => AppConfig::DRIVER_MYSQL,
            'host'      => $arrCredentials['teste_hostname'],
            'dbname'    => $arrCredentials['teste_database'],
            'user'      => $arrCredentials['teste_user'], // DbName_USER
            'password'  => $arrCredentials['teste_password'], // DbName_Password
            'charset'   => ''
        ]
    ]
];