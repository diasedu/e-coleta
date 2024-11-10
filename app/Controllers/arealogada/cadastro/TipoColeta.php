<?php
namespace app\Controllers\arealogada\cadastro;

use CodeIgniter\Controller;

class TipoColeta extends Controller
{
    private $logado;

    public string $titulo;

    public function __construct()
    {
        $this->logado = session()->get('logado');

        if (!$this->logado)
        {
            header('Location: /login');
            exit;
        }

        $this->TipoColetaModel = model('arealogada/cadastro/TipoColetaModel');
    }

    public function index(): string
    {
        return view('arealogada/cadastro/tipo-coleta/vw_principal', array('titulo' => 'Tipo de coleta'));
    }

    public function consultar(): void
    {
        $req = $this->request->getPost();

        $data = $this->TipoColetaModel->consultar($req);

        $res = view('arealogada/cadastro/tipo-coleta/vw_list', array('data' => $data));

        echo json_encode(['html' => $res]);
    }

    public function inserirAtualizar(): void
    {
        $req = $this->request->getPost();

        $res = $this->TipoColetaModel->inserirAtualizar($req);

        echo json_encode($res);
    }

    public function resgataRegistro(): void
    {
        $req = $this->request->getPost();

        $res = $this->TipoColetaModel->consultar($req);

        $res['registro'] = $res['list'][0];

        echo json_encode($res);
    }

    public function excluir(): void
    {
        $req = $this->request->getPost();

        $res = $this->TipoColetaModel->excluir($req);

        echo json_encode($res);
    }
}
