<?php

namespace app\Models;

use CodeIgniter\Model;
use Exception;
use PDO;

class LoginModel extends Model
{
  private object $ConexaoSQLModel;

  private object $con;

  public function __construct()
  {
    $this->ConexaoSQLModel = model('ConexaoSQLModel');

    $this->con = $this->ConexaoSQLModel->conectarAcesso();
  }

  public function autenticarLogin(array $data): array
  {
    try 
    {
      if (empty($data['email'])) {
        return
          [
            'level' => 'ERROR',
            'msg' => '<i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i> Informe o e-mail ou login.',
            'msgDev' => ''
          ];
      }

      if (empty($data['senha'])) {
        return
          [
            'level' => 'ERROR',
            'msg' => '<i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i> Informe a senha.',
            'msgDev' => ''
          ];
      }

      $sql ="
        SELECT idUsua,
               loginUsua,
               nmUsua
          FROM usuario
         WHERE loginUsua = :loginUsua
           AND senhaUsua = :senhaUsua
           AND staUsua = 'A'
      ";
      
      $stmt = $this->con->prepare($sql);
      $stmt->bindParam(':loginUsua', $data['email']);
      $stmt->bindParam(':senhaUsua', $data['senha']);
      $stmt->execute();

      $dataUsua = $stmt->fetch(PDO::FETCH_ASSOC);

      if (empty($dataUsua)) {
        return [
          'level' => 'ERROR',
          'msg' => '<i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i> Login ou senha inválido.',
          'msgDev' => ''
        ];
      }

      session()->set([
        'idUsua' => $dataUsua['idUsua'],
        'nmUsua' => $dataUsua['nmUsua'],
        'loginUsua' => $dataUsua['loginUsua'],
        'logado' => true
      ]);

      return [
        'level' => 'INFO',
        'msg' => '',
        'msgDev' => ''
      ];
    } catch (Exception $e) {
      $msgDev = $e->getMessage();
      
      return
        [
          'level' => 'ERROR',
          'msg' => '<i class="fa-solid fa-triangle-exclamation" style="color: #FFD43B;"></i> ' . MSG_ERRO,
          'msgDev' => $msgDev
        ];
    }
  }
}
