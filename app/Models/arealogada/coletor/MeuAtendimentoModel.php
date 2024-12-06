<?php

namespace app\Models\arealogada\coletor;

use Exception;
use PDO;
use DateTime;

class MeuAtendimentoModel
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
            $idTicket = ($data['filt_id_ticket'] ?? null);
            $nmTicket = (!empty($data['filt_nm_ticket']) ? '%' . mb_strtolower($data['filt_nm_ticket']) . '%' : null);
            $dtInclTicket = ($data['filt_dt_incl_ticket'] ?? null);
            $idStaTicket = ($data['filt_id_sta_ticket'] ?? null);

            $sql = "
                SELECT t.id_ticket,
	                   t.nm_ticket,
                       t.desc_ticket,
                       DATE_FORMAT(t.dt_incl_ticket, '%d/%m/%Y') AS dt_incl_ticket,
                       t.id_sta_ticket,
                       st.nm_sta_ticket,
                       t.cep,
                       t.logradouro,
                       t.numero,
                       t.complemento,
                       t.cidade,
                       t.estado
                  FROM ticket t
                    INNER JOIN status_ticket st ON (t.id_sta_ticket = st.id_sta_ticket)
                 WHERE 1 = 1
                   AND t.id_usua_coletor = :id_usua_coletor
            ";

            if (!empty($idTicket))
            {
                $sql .= "
                    AND t.id_ticket = :id_ticket
                ";
            }

            if (!empty($nmTicket))
            {
                $sql .= "
                    AND LOWER(t.nm_ticket) LIKE :nm_ticket COLLATE utf8mb4_unicode_ci
                ";
            }

            if (!empty($dtInclTicket))
            {
                $sql .= "
                    AND DATE_FORMAT(t.dt_incl_ticket, '%Y-%m-%d') = :dt_incl_ticket
                ";
            }

            if (!empty($idStaTicket))
            {
                $sql .= "
                    AND st.id_sta_ticket = :id_sta_ticket
                ";
            }

            $sql .= " ORDER BY t.dt_incl_ticket";

            $stmt = $this->con->prepare($sql);

            $stmt->bindValue(':id_usua_coletor', session()->get('id_usua'));

            if (!empty($idTicket))
            {
                $stmt->bindParam(':id_ticket', $idTicket);
            }

            if (!empty($nmTicket))
            {
                $stmt->bindParam(':nm_ticket', $nmTicket);
            }

            if (!empty($dtInclTicket))
            {
                $stmt->bindParam(':dt_incl_ticket', $dtInclTicket);
            }

            if (!empty($idStaTicket))
            {
                $stmt->bindParam(':id_sta_ticket', $idStaTicket);
            }

            $stmt->execute();

            $list = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $list = array_map(function($row)
            {
                $dataTicket = date('Y-m-d', strtotime(str_replace('/', '-', $row['dt_incl_ticket'])));

                $dataTicketDtFormat = new DateTime($dataTicket);
                $dtAtual = new DateTime();

                $dif = $dataTicketDtFormat->diff($dtAtual);

                $row['dif'] = $dif->days;
                $row['dt_html'] = $dataTicket;

                return $row;
            }, $list);

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

    public function mudarStatus(array $data = []): array
    {
        try
        {
            if (empty($data['id_sta_ticket']))
            {
                return [
                    'level' => 'ERROR',
                    'msg' => view('templates/vw_warning', array('msg' => 'Informe o status.')),
                ];
            }

            $sql = "
                UPDATE ticket 
                   SET id_sta_ticket = :id_sta_ticket,
                       id_usua_coletor = :id_usua_coletor
                 WHERE id_ticket = :id_ticket
            ";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id_sta_ticket', $data['id_sta_ticket']);
            $stmt->bindValue(':id_usua_coletor', session()->get('id_usua'));
            $stmt->bindParam(':id_ticket', $data['id_ticket']);

            $stmt->execute();

            return [
                'level' => 'INFO',
                'msg' => view('templates/vw_success', array('msg' => 'Dados salvos dentro do banco!')),
            ];
        } catch (Exception $e)
        {
            return [
                'level' => 'ERROR',
                'msg' => view('templates/vw_error', array('msg' => $e->getMessage())),
            ];
        }
    }
}
