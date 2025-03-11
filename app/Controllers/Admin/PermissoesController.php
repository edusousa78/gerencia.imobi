<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PermissaoModel;

class PermissoesController extends BaseController
{
    protected $permissaoModel;

    public function __construct()
    {
        $this->permissaoModel = new PermissaoModel();
    }

    public function index()
    {
        $data = [
            'titulo' => 'Gestão de Permissões',
            'permissoes' => $this->permissaoModel->findAll()
        ];

        return view('admin/permissoes/index', $data);
    }

    public function nova()
    {
        $data = [
            'titulo' => 'Nova Permissão',
            'modulos' => [
                'Cliente' => ['aCliente', 'eCliente', 'dCliente', 'vCliente'],
                'Imovel' => ['aImovel', 'eImovel', 'dImovel', 'vImovel'],
                'Locacao' => ['aLocacao', 'eLocacao', 'dLocacao', 'vLocacao'],
                'Venda' => ['aVenda', 'eVenda', 'dVenda', 'vVenda'],
                'Financeiro' => ['aFinanceiro', 'eFinanceiro', 'vFinanceiro'],
                'Configuracoes' => ['cUsuario', 'cPermissao', 'cParametros']
            ]
        ];

        return view('admin/permissoes/form', $data);
    }

    public function criar()
    {
        $dados = $this->request->getPost();
        
        // Serializa as permissões
        $permissoes = [];
        foreach ($dados['permissoes'] ?? [] as $permissao) {
            $permissoes[$permissao] = '1';
        }
        
        $this->permissaoModel->insert([
            'nome' => $dados['nome'],
            'permissoes' => serialize($permissoes),
            'situacao' => 1,
            'data' => date('Y-m-d')
        ]);

        return redirect()->to('/admin/permissoes')->with('success', 'Permissão criada com sucesso');
    }

    public function editar($id)
    {
        $permissao = $this->permissaoModel->find($id);
        
        if (!$permissao) {
            return redirect()->back()->with('error', 'Permissão não encontrada');
        }

        $data = [
            'titulo' => 'Editar Permissão',
            'permissao' => $permissao,
            'modulos' => [
                'Cliente' => ['aCliente', 'eCliente', 'dCliente', 'vCliente'],
                'Imovel' => ['aImovel', 'eImovel', 'dImovel', 'vImovel'],
                'Locacao' => ['aLocacao', 'eLocacao', 'dLocacao', 'vLocacao'],
                'Venda' => ['aVenda', 'eVenda', 'dVenda', 'vVenda'],
                'Financeiro' => ['aFinanceiro', 'eFinanceiro', 'vFinanceiro'],
                'Configuracoes' => ['cUsuario', 'cPermissao', 'cParametros']
            ]
        ];

        return view('admin/permissoes/form', $data);
    }

    public function atualizar($id)
    {
        $dados = $this->request->getPost();
        
        // Serializa as permissões
        $permissoes = [];
        foreach ($dados['permissoes'] ?? [] as $permissao) {
            $permissoes[$permissao] = '1';
        }
        
        $this->permissaoModel->update($id, [
            'nome' => $dados['nome'],
            'permissoes' => serialize($permissoes),
            'situacao' => $dados['situacao'] ?? 1
        ]);

        return redirect()->to('/admin/permissoes')->with('success', 'Permissão atualizada com sucesso');
    }

    public function excluir($id)
    {
        // Não permite excluir a permissão de Admin (id=1)
        if ($id == 1) {
            return redirect()->back()->with('error', 'Esta permissão não pode ser excluída');
        }

        $this->permissaoModel->delete($id);
        return redirect()->to('/admin/permissoes')->with('success', 'Permissão excluída com sucesso');
    }
}
