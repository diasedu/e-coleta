<?php

namespace App\Controllers;

use App\DTO\UserDTO;
use App\Models\UserModel;
use App\Libraries\Auth;
use App\Libraries\User;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends Controller {
    protected UserModel $userModel;

    public function __construct() {
        helper('form');
    }

    public function index(): string {
        return view('vw_login');
    }

    public function auth(): ResponseInterface {
        $post = $this->request->getPost();

        $rules = [
            'email' => 'required',
            'pass'  => 'required'
        ];

        if (!$this->validateData($post, $rules)) {
            return $this->response->setJSON([
                'error'   => true,
                'message' => validation_list_errors()
            ]);
        }

        $userDTO = new UserDTO(
            email: $post['email'], 
            pass:  $post['pass'],
            name:  null
        );

        $auth = Auth::auth($userDTO);

        return $this->response->setJSON($auth);
    }

    public function UserRegister(): ResponseInterface {
        $post = $this->request->getPost();

        $rules = [
            'user_name'         => 'required|max_length[200]',
            'user_email'        => 'required|valid_email|max_length[200]',
            'user_pass'         => 'required|min_length[10]|alpha_numeric',
            'user_confirm_pass' => 'required|matches[user_pass]'
        ];

        if (!$this->validateData($post, $rules)) {
            return $this->response->setJSON([
                'error'   => true,
                'message' => validation_list_errors()
            ]);
        }

        $userDTO = new UserDTO(
            email: $post['user_email'], 
            pass:  $post['user_pass'],
            name:  $post['user_name']
        );

        $register = User::Register($userDTO);

        return $this->response->setJSON($register);
    }

    public function logout(): RedirectResponse {
        session()->destroy();

        return redirect()->to('/login');
    }
}
