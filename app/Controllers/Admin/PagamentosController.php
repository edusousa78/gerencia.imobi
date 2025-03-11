<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PagamentoModel;
use App\Models\LocacaoModel;

class PagamentosController extends BaseController
{
    protected $pagamentoModel;
    protected $locacaoModel;

    public function __construct()
    {
        $this->pagamentoModel = new PagamentoModel();
        $this->locacaoModel = new LocacaoModel();
    }

    public function index($idLocacao)
    {
        $locacao = $this->locacaoModel->select('locacoes.*, imoveis.titulo as imovel, clientes.nomeCliente as cliente')
                                     ->join('imoveis', 'imoveis.idImovel = locacoes.idImovel')
                                     ->join('clientes', 'clientes.idClientes = locacoes.idClientes')
                                     ->find($idLocacao);

        $data = [
            'titulo' => 'Pagamentos da Locação',
            'locacao' => $locacao,
            'pagamentos' => $this->pagamentoModel->where('idLocacao', $idLocacao)
                                               ->orderBy('competencia', 'ASC')
                                               ->findAll()
        ];
        
        return view('admin/pagamentos/index', $data);
    }

    public function novo($idLocacao)
    {
        $data = [
            'titulo' => 'Novo Pagamento',
            'locacao' => $this->locacaoModel->find($idLocacao)
        ];
        
        return view('admin/pagamentos/form', $data);
    }
}
