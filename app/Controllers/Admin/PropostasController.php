<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PropostaModel;

class PropostasController extends BaseController
{
    protected $propostaModel;

    public function __construct()
    {
        $this->propostaModel = new PropostaModel();
    }

    public function index()
    {
        $data = [
            'titulo' => 'Gestão de Propostas',
            'propostas' => $this->propostaModel->findAll()
        ];

        return view('admin/propostas/index', $data);
    }

    public function criar()
    {
        if ($this->request->getMethod() === 'post') {
            $dados = $this->request->getPost();
            $this->propostaModel->insert($dados);
            return redirect()->to('/admin/propostas')->with('success', 'Proposta criada com sucesso');
        }
    }
}
