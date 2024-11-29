<?php
namespace app\Controllers\arealogada\solicitante;

use CodeIgniter\Controller;

class Ticket extends Controller
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

    }

    public function index(): string
    {
        return view('arealogada/solicitante/ticket/vw_principal', array('titulo' => 'Ticket'));
    }

    public function consultar(): void
    {
        $model = model('UsuarioModel');
        $req = $this->request->getPost();

        # Inclui condição para pegar apenas os coletores.
        $req['filt_tipo_perfil'] = 3;

        $data = $model->consultar($req);
        $res = view('arealogada/solicitante/ticket/vw_list', array('data' => $data));

        echo json_encode(['html' => $res]);
    }

    public function inserirAtualizar(): void
    {
        $req = $this->request->getPost();

        $res = $this->coletorModel->inserirAtualizar($req);

        echo json_encode($res);
    }

    public function resgataRegistro(): void
    {
        $req = $this->request->getPost();

        $res = $this->coletorModel->consultar($req);

        $res['registro'] = $res['list'][0];

        echo json_encode($res);
    }

    public function excluir(): void
    {
        $req = $this->request->getPost();

        $res = $this->coletorModel->excluir($req);

        echo json_encode($res);
    }
}
