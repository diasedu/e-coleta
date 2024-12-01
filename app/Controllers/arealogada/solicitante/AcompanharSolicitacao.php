<?php
namespace app\Controllers\arealogada\solicitante;

use CodeIgniter\Controller;

class AcompanharSolicitacao extends Controller
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
        $model = model('arealogada/solicitante/AcompanharSolicitacaoModel');
        $statusTicketModel = model('arealogada/StatusTicketModel');

        $listStaTicket = $statusTicketModel->consultar(['sta_ticket' => 'A']);

        $data = [
            'titulo' => 'Acompanhar solicitação',
            'listStaTicket' => $listStaTicket
        ];

        return view('arealogada/solicitante/acompanhar-solicitacao/vw_principal', $data);
    }

    public function consultar(array $data = []): string
    {
        $model = model('arealogada/solicitante/AcompanharSolicitacaoModel');

        $input = $this->request->getPost();

        $data = $model->consultar($input);

        $html = view('arealogada/solicitante/acompanhar-solicitacao/vw_list', $data);
        
        return $html;
    }

    public function ver(): void
    {
        $model = model('arealogada/solicitante/AcompanharSolicitacaoModel');

        $input = $this->request->getPost();

        $data = $model->consultar($input);

        echo json_encode($data);
    }
}
