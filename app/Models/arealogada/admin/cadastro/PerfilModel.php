<?php

namespace app\Models\arealogada\admin\cadastro;

use Exception;
use PDO;

class PerfilModel
{
    private $conSqlModel;

    public function __construct()
    {
        $this->conSqlModel = model('ConexaoSQLModel');
    }

    public function consultar(array $data = []): array
    {
        $con = $this->conSqlModel->conectar();

        $id = ($data['filt_id_perfil'] ?? null);
        $desc = (!empty($data['filt_desc_perfil']) ? '%' . $data['filt_desc_perfil'] . '%' : null);
        $sta = ($data['filt_sta_perfil'] ?? null);

        try
        {
            $sql = "
                SELECT id_perfil,
                       desc_perfil,
                       sta_perfil
                  FROM perfil
                 WHERE 1 = 1
            ";

            if (!empty($id))
            {
                $sql .= " 
                    AND id_perfil = :id 
                ";
            }

            if (!empty($desc))
            {
                $sql .= " 
                    AND desc_perfil LIKE :desc
                ";
            }

            if (!empty($sta))
            {
                $sql .= " 
                    AND sta_perfil = :sta 
                ";
            }

            $sql .= " 
                ORDER BY sta_perfil, desc_perfil
            ";

            $stmt = $con->prepare($sql);

            if (!empty($id))
            {
                $stmt->bindParam(':id', $id);
            }

            if (!empty($desc))
            {
                $stmt->bindParam(':desc', $desc);
            }

            if (!empty($sta))
            {
                $stmt->bindParam(':sta', $sta);
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
                'msg' => '<i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i> ' . $e->getMessage(),
                'list' => []
            ];
        }
    }
}
