<?php

namespace app\Models\arealogada\solicitante;

use Exception;
use PDO;

class SolicitarColetaModel
{
    private $ConexaoSQLModel;

    private $con;

    public function __construct()
    {
        $this->ConexaoSQLModel = model('ConexaoSQLModel');

        $this->con = $this->ConexaoSQLModel->conectar();
    }

    public function consultarCep(array $data): array
    {
        try
        {
            if (empty($data['cep']))
            {
                return [
                    'level' => 'ERROR',
                    'msg' => view('templates/vw_warning', array('msg' => 'Informe o CEP.')),
                    'data' => []
                ];
            }

            $url = "https://viacep.com.br/ws/{$data['cep']}/json/";

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

            $response = json_decode(curl_exec($curl), true);
            
            curl_close($curl);

            $list = [
                'logradouro' => $response['logradouro'],
                'bairro' => $response['bairro'],
                'uf' => $response['uf'],
                'cidade' => $response['estado']
            ];
            
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

    public function criarSolicitacao(array $data): array
    {
        try
        {

            if (empty($data['titulo']))
            {
                return [
                    'level' => 'ERROR',
                    'msg' => view('templates/vw_warning', array('msg' => 'Informe o título.')),
                    'field' => '#titulo',
                    'fieldInfo' => '#tituloInfo'
                ];
            }

            if (empty($data['descricao']))
            {
                return [
                    'level' => 'ERROR',
                    'msg' => view('templates/vw_warning', array('msg' => 'Informe a descrição.')),
                    'field' => '#descricao',
                    'fieldInfo' => '#descricaoInfo'
                ];
            }

            
            if (empty($data['numero']))
            {
                return [
                    'level' => 'ERROR',
                    'msg' => view('templates/vw_warning', array('msg' => 'Informe o número.')),
                    'field' => '#numero',
                    'fieldInfo' => '#enderecoInfo'
                ];
            }

            $sql = "
                INSERT INTO ticket 
                    (nm_ticket, desc_ticket, dt_incl_ticket, logradouro, cep, numero, complemento, cidade, estado, id_usua_resp, bairro)
                VALUES
                    (:nm_ticket, :desc_ticket, SYSDATE(), :logradouro, :cep, :numero, :complemento, :cidade, :estado, :id_usua_resp, :bairro)
            ";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':nm_ticket', $data['titulo']);
            $stmt->bindParam(':desc_ticket', $data['descricao']);
            $stmt->bindParam(':logradouro', $data['logradouro']);
            $stmt->bindParam(':cep', $data['cep']);
            $stmt->bindParam(':numero', $data['numero']);
            $stmt->bindParam(':complemento', $data['complemento']);
            $stmt->bindParam(':cidade', $data['cidade']);
            $stmt->bindParam(':estado', $data['uf']);
            $stmt->bindValue(':id_usua_resp', session()->get('id_usua'));
            $stmt->bindParam(':bairro', $data['bairro']);
            $stmt->execute();

            return [
                'level' => 'INFO',
                'msg' => view('templates/vw_success', array('msg' => 'Dados salvos dentro do banco de dados!')),
                'field' => '#formInfo',
                'fieldInfo' => '#formInfo'
            ];
        } catch (Exception $e)
        {
            return [
                'level' => 'ERROR',
                'msg' => view('templates/vw_error', array('msg' => $e->getMessage())),
                'field' => '#formInfo',
                'fieldInfo' => '#formInfo'
            ];
        }
    }
}
