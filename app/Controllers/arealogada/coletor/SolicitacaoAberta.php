<?php
namespace app\Controllers\arealogada\coletor;

use CodeIgniter\Controller;

class SolicitacaoAberta extends Controller
{
    private $logado;

    public string $titulo;

    private object $model;

    public function __construct()
    {
        $this->logado = session()->get('logado');

        if (!$this->logado)
        {
            header('Location: /login');
            exit;
        }

        $this->model = model('arealogada/coletor/SolicitacaoAbertaModel');

    }

    public function index(): string
    {
        $statusTicketModel = model('arealogada/StatusTicketModel');

        $listStaTicket = $statusTicketModel->consultar(['sta_ticket' => 'A']);

        $data = [
            'titulo' => 'Solicitação aberta',
            'listStaTicket' => $listStaTicket
        ];

        return view('arealogada/coletor/solicitacao-aberta/vw_principal', $data);
    }

    public function consultar(array $data = []): string
    {
        $input = $this->request->getPost();

        $data = $this->model->consultar($input);

        $html = view('arealogada/coletor/solicitacao-aberta/vw_list', $data);
        
        return $html;
    }

    public function ver(): void
    {
        $input = $this->request->getPost();

        $data = $this->model->consultar(['filt_id_ticket' => $input['id_ticket']]);

        echo json_encode($data);
    }

    public function mudarStatus(): void
    {
        $input = $this->request->getPost();

        $data = $this->model->mudarStatus($input);

        echo json_encode($data);
    }
}
