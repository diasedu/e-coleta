<?php
namespace app\Controllers\arealogada;

use CodeIgniter\Controller;

class Principal extends Controller
{
    private $logado;

    public function __construct()
    {
        $this->logado = session()->get('logado');

        if (!$this->logado)
        {
            header('Location: /login');
            exit;
        }
    }
    
    public function index(): string
    {
        return view('arealogada/vw_principal');
    }
}
