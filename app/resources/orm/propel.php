<?php

require_once(__DIR__ . "/../env.php");

return [
    'propel' => [
        'database' => [
            'connections' => [
                'default' => [
                    'adapter' => 'mysql',
                    'dsn' => 'mysql:host=' . $env['sql_uri'] . ';port=' . $env['sql_port'] . ';dbname=' . $env['sql_db'],
                    'user' => $env['sql_user'],
                    'password' => $env['sql_password'],
                    'settings' => [
                        'charset' => 'utf8'
                    ],
                    'options': => [
                        'PDO::MYSQL_ATTR_INIT_COMMAND' => 'SET NAMES utf8',
                        'PDO::MYSQL_ATTR_SSL_CA' => $env['sql_cert'],
                        'PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT' => false,
                    ],
                ]
            ]
        ]
    ]
];

?>