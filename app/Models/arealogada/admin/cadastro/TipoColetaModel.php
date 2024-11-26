<?php

namespace app\Models\arealogada\cadastro;

use Exception;
use PDO;

class TipoColetaModel
{

  public function __construct()
  {
    $this->ConexaoSQLModel = model('ConexaoSQLModel');

    $this->con = $this->ConexaoSQLModel->conectar();
  }
    public function consultar(array $data): array
    {
        $id = ($data['filtIdTipoCol'] ?? null);
        $nm = (!empty($data['filtNmTipoCol']) ? '%' . $data['filtNmTipoCol'] . '%' : null);
        $sta = ($data['filtStaTipoCol'] ?? null);

        try
        {
            $sql = "
                SELECT idTipoCol,
                       nmTipoCol,
                       staTipoCol
                  FROM TipoColeta
                 WHERE 1 = 1
            ";

            if (!empty($id))
            {
                $sql .= " AND idTipoCol = :id ";
            }

            if (!empty($nm))
            {
                $sql .= " AND nmTipOCol LIKE :nm ";
            }

            if (!empty($sta))
            {
                $sql .= " AND staTipOCol = :sta ";
            }

            $sql .= "
                 ORDER BY staTipoCol, nmTipoCol
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

    public function inserirAtualizar(array $data): array
    {
        try
        {

            if (empty($data['nmTipoCol']))
            {
                return [
                    'level' => 'ERROR',
                    'msg' => view('templates/vw_warning', array('msg' => 'Informe o nome.')),
                    'data' => []
                ];
            }

            if (mb_strlen($data['nmTipoCol']) > 30)
            {
                return [
                    'level' => 'ERROR',
                    'msg' => view('templates/vw_warning', array('msg' => 'O nome deve conter até 30 caracteres.')),
                    'data' => []
                ];
            }

            if (empty($data['staTipoCol']))
            {
                return [
                    'level' => 'ERROR',
                    'msg' => view('templates/vw_warning', array('msg' => 'Informe o status.')),
                    'data' => []
                ];
            }

            $sql = '';

            if (empty($data['idTipoCol']))
            {
                $sql = "
                    INSERT INTO tipoColeta (nmTipoCol, staTipoCol)
                     VALUES (:nmTipoCol, :staTipoCol)
                ";
            } else
            {
                $sql = "
                    UPDATE tipoColeta
                       SET nmTipoCol = :nmTipoCol,
                           staTipoCol = :staTipoCol
                     WHERE idTipoCol = :idTipoCol
                ";
            }

            $stmt = $this->con->prepare($sql);

            if (!empty($data['idTipoCol']))
            {
                $stmt->bindParam(':idTipoCol', $data['idTipoCol']);
            }

            $stmt->bindParam(':nmTipoCol', $data['nmTipoCol']);
            $stmt->bindParam(':staTipoCol', $data['staTipoCol']);
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

    public function excluir(array $data): array
    {
        try
        {
            $sql = "
                DELETE FROM tipoColeta WHERE idTipoCol = :idTipoCol
            ";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idTipoCol', $data['idTipoCol']);
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
