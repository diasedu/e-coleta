<?php

namespace app\Models\arealogada;

use Exception;
use PDO;

class StatusTicketModel
{
    private $ConexaoSQLModel;

    private $con;

    public function __construct()
    {
        $this->ConexaoSQLModel = model('ConexaoSQLModel');

        $this->con = $this->ConexaoSQLModel->conectar();
    }

    public function consultar(array $data = []): array
    {
        try
        {
            $sql = "
                SELECT id_sta_ticket,
                       nm_sta_ticket,
                       sta_ticket
                  FROM status_ticket
                 WHERE 1 = 1
            ";

            if (!empty($data['sta_ticket']))
            {
                $sql .= "
                    AND sta_ticket = :sta_ticket
                ";
            }
            
            $stmt = $this->con->prepare($sql);

            if (!empty($data['sta_ticket']))
            {
               $stmt->bindParam(':sta_ticket', $data['sta_ticket']);
            }

            $stmt->execute();
            $list = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return [
                'level' => 'INFO',
                'msg' => '',
                'list' => $list
            ];
        } catch (Exception $e)
        {
            return [
                'level' => 'ERROR',
                'msg' => view('templates/vw_error', array('msg' => $e->getMessage())),
                'list' => []
            ];
        }
    }
}
