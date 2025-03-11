<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EmpreendimentoModel;

class EmpreendimentosController extends BaseController
{
    protected $empreendimentoModel;

    public function __construct()
    {
        $this->empreendimentoModel = new EmpreendimentoModel();
    }

    public function index()
    {
        $data = [
            'titulo' => 'Gerenciar Empreendimentos',
            'empreendimentos' => $this->empreendimentoModel->findAll()
        ];
        
        return view('admin/empreendimentos/index', $data);
    }

    public function novo()
    {
        $data = [
            'titulo' => 'Novo Empreendimento'
        ];
        
        return view('admin/empreendimentos/form', $data);
    }

    public function criar()
    {
        if ($this->validate([
            'nome' => 'required|min_length[3]',
            'tipo' => 'required',
            'status' => 'required',
            'cidade' => 'required',
            'estado' => 'required'
        ])) {
            $dados = $this->request->getPost();
            $dados['dataCadastro'] = date('Y-m-d');
            
            if ($this->empreendimentoModel->insert($dados)) {
                return redirect()->to('/admin/empreendimentos')->with('sucesso', 'Empreendimento cadastrado com sucesso!');
            }
        }
        
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
}
