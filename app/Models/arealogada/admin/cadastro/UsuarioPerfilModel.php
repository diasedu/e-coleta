<?php

namespace app\Models\arealogada\admin\cadastro;

use Exception;
use PDO;

class UsuarioPerfilModel
{
    private $ConexaoSQLModel;

    private $con;

    public function __construct()
    {
        $this->ConexaoSQLModel = model('ConexaoSQLModel');

        $this->con = $this->ConexaoSQLModel->conectar();
    }

    public function vincularDesvincular(array $data): array
    {
        try
        {
            if (empty($data['id_perfil']))
            {
                return [
                    'level' => 'ERROR',
                    'msg' => view('templates/vw_warning', array('msg' => 'Informe o perfil do usuário.')),
                    'data' => []
                ];
            }

            $sql = "
                SELECT 1
                  FROM usuario_perfil
                 WHERE id_usua = :id_usua
            ";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id_usua', $data['id_usua']);
            $stmt->execute();
            $existe_perfil = $stmt->fetch(PDO::FETCH_BOUND);

            if ($existe_perfil)
            {
                $sql = " 
                    UPDATE usuario_perfil 
                       SET id_perfil = :id_perfil 
                     WHERE id_usua = :id_usua
                ";
            } else
            {
                $sql = "
                    INSERT INTO usuario_perfil(id_usua, id_perfil)
                    VALUES(:id_usua, :id_perfil)
                ";
            }

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id_usua', $data['id_usua']);
            $stmt->bindParam(':id_perfil', $data['id_perfil']);
            $stmt->execute();

            return [
                'level' => 'INFO',
                'msg' => view('templates/vw_success', array('msg' => 'Dados salvos dentro do banco de dados!')),
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
