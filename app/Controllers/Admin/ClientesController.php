<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ClienteModel;

class ClientesController extends BaseController
{
    protected $clienteModel;

    public function __construct()
    {
        $this->clienteModel = new ClienteModel();
    }

    public function index()
    {
        $data = [
            'titulo' => 'Gerenciar Clientes',
            'clientes' => $this->clienteModel->findAll()
        ];
        
        return view('admin/clientes/index', $data);
    }

    public function novo()
    {
        $data = [
            'titulo' => 'Novo Cliente'
        ];
        
        return view('admin/clientes/form', $data);
    }

    public function criar()
    {
        if (!$this->validate([
            'nomeCliente' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'documento' => 'required',
            'telefone' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dados = $this->request->getPost();
        $dados['dataCadastro'] = date('Y-m-d');
        
        $this->clienteModel->insert($dados);
        return redirect()->to('/admin/clientes')->with('success', 'Cliente cadastrado com sucesso!');
    }
}
