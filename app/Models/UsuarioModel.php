<?php

namespace app\Models;

use Exception;
use PDO;

class UsuarioModel
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
        $id = ($data['filt_id_usua'] ?? null);
        $nm = (!empty($data['filt_nm_usua']) ? '%' . $data['filt_nm_usua'] . '%' : null);
        $sta = ($data['filt_sta_usua'] ?? null);
        $id_perfil = ($data['filt_id_perfil'] ?? null);

        try
        {
            $sql = "
                SELECT u.id_usua,
                       u.nm_usua,
                       u.sta_usua,
                       p.id_perfil,
                       p.desc_perfil
                  FROM usuario u
                    LEFT JOIN usuario_perfil up ON (u.id_usua = up.id_usua)
                    LEFT JOIN perfil p ON (up.id_perfil = p.id_perfil)
                 WHERE 1 = 1
            ";

            if (!empty($id))
            {
                $sql .= " AND u.id_usua = :id ";
            }

            if (!empty($nm))
            {
                $sql .= " AND u.nm_usua LIKE :nm ";
            }

            if (!empty($sta))
            {
                $sql .= " AND u.sta_usua = :sta ";
            }

            if (!empty($id_perfil))
            {
                $sql .= '
                    AND up.id_perfil = :id_perfil
                ';
            }

            $sql .= "
                 ORDER BY sta_usua, nm_usua
            ";

            $stmt = $this->con->prepare($sql);

            if (!empty($id))
            {
                $stmt->bindParam(':id', $id);
            }

            if (!empty($nm))
            {
                $stmt->bindParam(':nm', $nm);
            }

            if (!empty($sta))
            {
                $stmt->bindParam(':sta', $sta);
            }

            if (!empty($id_perfil))
            {
                $stmt->bindParam(':id_perfil', $id_perfil);
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

    public function excluir(array $data): array
    {
        try
        {
            $sql = "
                DELETE FROM usuario WHERE id_usua = :id_usua
            ";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id_usua', $data['id_usua']);
            $stmt->execute();

            return [
                'level' => 'INFO',
                'msg' => view('templates/vw_success', array('msg' => 'Registro excluído.')),
                'data' => json_encode($data)
            ];
        } catch (Exception $e)
        {
            return [
                'level' => 'ERROR',
                'msg' => view('templates/vw_error', array('msg' => $e->getMessage())),
                'data' => []
            ];
        }
    }
}
