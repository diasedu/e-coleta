<?php
namespace app\Controllers\arealogada\admin\cadastro;

use App\Controllers\BaseController;
use PhpParser\Node\Expr\Cast\Object_;

class UsuarioPerfil extends BaseController
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
        $perfil_model = model('arealogada/admin/cadastro/PerfilModel');

        $req = $this->request->getPost();
        $list_perfil = $perfil_model->consultar($req);

        return view(
            'arealogada/cadastro/usuario-perfil/vw_principal', 
            [
                'titulo' => 'Perfil de usuários',
                'data' => [
                    'list_perfil' => $list_perfil['list']
                ]
            ]
        );
    }

    public function consultar(): void
    {
        $usuario_model = model('UsuarioModel');

        $req = $this->request->getPost();

        $data = $usuario_model->consultar($req);

        $res = view('arealogada/cadastro/usuario-perfil/vw_list', array('data' => $data));

        echo json_encode(['html' => $res]);
    }

    public function vincularDesvincular(): void
    {
        $usuario_perfil_model = model('arealogada/admin/cadastro/UsuarioPerfilModel');

        $req = $this->request->getPost();

        $data = $usuario_perfil_model->vincularDesvincular($req);

        echo json_encode($data);
    }

    public function resgataRegistro(): void
    {
        $usuario_model = model('UsuarioModel');

        $req = $this->request->getPost();

        $data = $usuario_model->consultar($req);

        echo json_encode($data);
    }
}
