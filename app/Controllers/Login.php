<?php

namespace App\Controllers;

use App\Models\LoginModel;
use CodeIgniter\Controller;

class Login extends Controller
{

    public function __construct()
    {
        $this->LoginModel = model('LoginModel');
    }
    public function index(): string
    {
        return view('vw_login');
    }

    public function autenticarLogin()
    {   
        $req = $this->request->getPost();

        $autenticado = $this->LoginModel->autenticarLogin($req);

        echo json_encode($autenticado);
    }

    public function cadastrar()
    {   
        return view('vw_cadastro');
    }

    public function cadastrarUsuario(): void
    {
        $req = $this->request->getPost();

        $res = $this->LoginModel->cadastrarUsuario($req);

        echo json_encode($res);
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}
