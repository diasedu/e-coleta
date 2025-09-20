<?php 

namespace App\Libraries;

use App\DTO\UserDTO;
use App\Models\UserModel;

class Auth {
    private const ACTIVE = 1;

    protected static $session = session();

    public static function auth(UserDTO $user): array {
        $userModel = new UserModel();

        $userData = $userModel
            ->where('user_email',  $user->email)
            ->where('user_status', self::ACTIVE)
        ->findAll();
        
        if (empty($userData)) {
            return [
                'error'   => true,
                'message' => 'Não foi localizado o seu cadastro.' 
            ];
        }

        if (!password_verify($user->pass, $userData[0]->user_pass)) {
            return [
                'error'   => true,
                'message' => 'Senha incorreta.'
            ];
        }

        self::$session->set([
            'user_id'     => $userData[0]->user_id,
            'user_name'   => $userData[0]->user_name,
            'user_email'  => $userData[0]->user_email,
            'user_status' => $userData[0]->user_status
        ]);
        
        return [
            'error'   => false,
            'message' => 'Autenticado com sucesso.'
        ];
    }
}