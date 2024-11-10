<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use PDO;

class ConexaoSQLModel
{
    public function __construct()
    {
    }

    public function conectar(): mixed
    {
        try
        {
            $dbHost = getenv('DB_HOST');
            $dbName = getenv('DB_NAME');
            $dbUser = getenv('DB_USER');
            $dbPass = getenv('DB_PASS');

            $con = new PDO("mysql:host={$dbHost};dbname={$dbName}", $dbUser, $dbPass);

            $con->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);

            return $con;

        } catch (Exception $e)
        {
            return [
                'level' => 'error',
                'msg' => $e->getMessage()
            ];
        }
    }
}