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
                SELECT u.id_usua,
                       u.login_usua,
                       u.nm_usua,
                       up.id_perfil
                  FROM usuario u
                    INNER JOIN usuario_perfil up ON (u.id_usua = up.id_usua)
                 WHERE u.login_usua = :login_usua
                   AND u.senha_usua = :senha_usua
                   AND u.sta_usua = 'A'
            ";
            
            $senha = md5($data['senha']);
            
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':login_usua', $data['email']);
            $stmt->bindParam(':senha_usua', $senha);
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
                'id_usua' => $dataUsua['id_usua'],
                'nm_usua' => $dataUsua['nm_usua'],
                'login_usua' => $dataUsua['login_usua'],
                'logado' => true,
                'id_perfil' => $dataUsua['id_perfil']
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
                SELECT 1 FROM usuario WHERE login_usua = :email
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
                INSERT INTO usuario (nm_usua, login_usua, senha_usua, sta_usua, dt_incl)
                VALUES (:nm_usua, :login_usua, :senha_usua, 'A', sysdate())
            ";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':nm_usua', $data['nome']);
            $stmt->bindParam(':login_usua', $data['email']);
            $stmt->bindParam(':senha_usua', $senha);
            $stmt->execute();

            $id_usua = $this->con->lastInsertId();
            
            $sql = "
                INSERT INTO usuario_perfil (id_usua, id_perfil)
                VALUES (:id_usua, 2)
            ";

            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id_usua', $id_usua);
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
