<?php
namespace app\Controllers\arealogada\solicitante;

use CodeIgniter\Controller;

class SolicitarColeta extends Controller
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
        return view(
            'arealogada/solicitante/solicitar-coleta/vw_principal', 
            array(
                'titulo' => 'Solicitar Coleta'
            )
        );
    }

    public function consultarCep(): void
    {
        $solicitar_coleta_model = model('/arealogada/solicitante/SolicitarColetaModel');

        $req = $this->request->getPost();

        $data = $solicitar_coleta_model->consultarCep($req);

        echo json_encode($data);
    }

    public function criarSolicitacao(): void
    {
        $model = model('/arealogada/solicitante/SolicitarColetaModel');

        $req = $this->request->getPost();

        $data = $model->criarSolicitacao($req);

        echo json_encode($data);
    }
}
