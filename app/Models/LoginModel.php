<?php

namespace app\Models;

use Exception;
use PDO;

class LoginModel
{

  private object $con;

  public function __construct()
  {
    $this->ConexaoSQLModel = model('ConexaoSQLModel');

    $this->con = $this->ConexaoSQLModel->conectar();
  }
    public function autenticarLogin(array $data): array
    {
        try 
        {
            if (empty($data['email'])) 
            {
                return [
                    'level' => 'ERROR',
                    'msg' => '<i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i> Informe o e-mail ou login.',
                ];
            }

            if (empty($data['senha'])) 
            {
                return [
                    'level' => 'ERROR',
                    'msg' => '<i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i> Informe a senha.',
                ];
            }

            $sql ="
                SELECT idUsua,
                       loginUsua,
                       nmUsua,
                       tipoCadastro
                  FROM acesso.usuario
                 WHERE loginUsua = :loginUsua
                   AND senhaUsua = :senhaUsua
                   AND staUsua = 'A'
            ";
            
            $senha = md5($data['senha']);
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':loginUsua', $data['email']);
            $stmt->bindParam(':senhaUsua', $senha);
            $stmt->execute();

            $dataUsua = $stmt->fetch(PDO::FETCH_ASSOC);

            if (empty($dataUsua)) 
            {
                return [
                    'level' => 'ERROR',
                    'msg' => '<i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i> Login ou senha inválido.',
                ];
            }

            session()->set([
                'idUsua' => $dataUsua['idUsua'],
                'nmUsua' => $dataUsua['nmUsua'],
                'loginUsua' => $dataUsua['loginUsua'],
                'tipoCadastro' => $dataUsua['tipoCadastro'],
                'logado' => true
            ]);

            return [
                'level' => 'INFO',
                'msg' => '',
            ];
        } catch (Exception $e) 
        {
            return [
                'level' => 'ERROR',
                'msg' => '<i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i> ' . $e->getMessage()
            ];
        }
    }

    public function cadastrarUsuario(array $data): array
    {
        try 
        {
            if (empty($data['nome']))
            {
                return  [
                    'level' => 'ERROR',
                    'msg' => '<i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i> Informe o seu nome.',
                ];
            }

            if (empty($data['email']))
            {
                return  [
                    'level' => 'ERROR',
                    'msg' => '<i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i> Informe o seu e-mail.',
                ];
            }

            if (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false)
            {
                return  [
                    'level' => 'ERROR',
                    'msg' => '<i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i> Informe um e-mail válido.',
                ];
            }

            if (empty($data['senha']))
            {
                return  [
                    'level' => 'ERROR',
                    'msg' => '<i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i> Informe uma senha.',
                ];
            }

            if (mb_strlen($data['senha']) < 8)
            {
                return  [
                    'level' => 'ERROR',
                    'msg' => '<i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i> Informe uma senha forte. Dica: No minimo 8 caracteres.',
                ];
            }

            $sql = "
                SELECT 1 FROM acesso.usuario WHERE loginUsua = :email
            ";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':email', $data['email']);
            $stmt->execute();
            $emailExiste = $stmt->fetch(PDO::FETCH_COLUMN);

            if ($emailExiste)
            {
                return [
                    'level' => 'ERROR',
                    'msg' => '<i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i> O e-mail informado já está em uso.'
                ];
            }

            $senha = md5($data['senha']);

            $sql = "
                INSERT INTO acesso.usuario (nmUsua, loginUsua, senhaUsua, staUsua, tipoCadastro, dtIncl)
                VALUES (:nmUsua, :loginUsua, :senhaUsua, 'A', :tipoCadastro, sysdate())
            ";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':nmUsua', $data['nome']);
            $stmt->bindParam(':loginUsua', $data['email']);
            $stmt->bindParam(':senhaUsua', $senha);
            $stmt->bindParam(':tipoCadastro', $data['tipoCadastro']);
            $stmt->execute();

            return [
                'level' => 'INFO',
                'msg' => '<i class="fa-solid fa-check"></i> Cadastrado!' 
            ];
        } catch (Exception $e) {
            return [
                'level' => 'ERROR',
                'msg' => '<i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i> ' . $e->getMessage()
            ];
        }
    }
}
