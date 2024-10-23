<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use PDO;

class ConexaoSQLModel extends Model
{
    public function __construct()
    {
        
    }

    public function conectarAcesso(): mixed
    {   
        try 
        {
            $host = getenv('ACESSO_HOST');
            $dbName = getenv('ACESSO_NOME');
            $user = getenv('ACESSO_USER');
            $pass = getenv('ACESSO_PASS');

            $con = new PDO("mysql:host={$host};dbname={$dbName}", $user, $pass);
            
            return $con;

        } catch (Exception $e)
        {
            return 
            [
                'level' => 'error',
                'msg' => $e->getMessage()
            ];
        }
        
    }
}