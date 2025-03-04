<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    /**
     * The default connection group name.
     *
     * @var string
     */
    public string $defaultGroup = 'default';

    /**
     * The database connection settings.
     *
     * @var array
     */
    public array $default = [
        'DSN'      => '',
        'hostname' => '',
        'username' => '',
        'password' => '',
        'database' => '',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'cacheOn'  => false,
        'cacheDir' => '',
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 3306,
    ];
}
