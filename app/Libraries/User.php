<?php 

namespace App\Libraries;

use App\DTO\UserDTO;
use App\Models\UserModel;

class User {
    public static function Register(UserDTO $user): array {
        $userModel = new UserModel();

        $userData = $userModel
            ->where('user_email', $user->email)
            ->findAll();
        
        if (!empty($userData)) {
            return [
                'error'   => true,
                'message' => 'Já existe um cadastro com este e-mail.' 
            ];
        }

        $registered = $userModel->insert([
            'user_name'   => $user->name,
            'user_email'  => $user->email,
            'user_pass'   => password_hash($user->pass, PASSWORD_BCRYPT, ['cost' => 12]),
            'user_status' => 1
        ]);
        
        return [
            'error'   => false,
            'message' => 'Usuário cadastrado com sucesso.'
        ];
    }
}