<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LocacaoModel;
use App\Models\PagamentoModel;
use App\Models\ImovelModel;

class RelatoriosController extends BaseController
{
    protected $locacaoModel;
    protected $pagamentoModel;
    protected $imovelModel;

    public function __construct()
    {
        $this->locacaoModel = new LocacaoModel();
        $this->pagamentoModel = new PagamentoModel();
        $this->imovelModel = new ImovelModel();
    }

    public function inadimplencia()
    {
        $data = [
            'titulo' => 'Relatório de Inadimplência',
            'inadimplentes' => $this->pagamentoModel
                ->select('locacoes_pagamentos.*, locacoes.idImovel, imoveis.titulo as imovel, clientes.nomeCliente')
                ->join('locacoes', 'locacoes.idLocacao = locacoes_pagamentos.idLocacao')
                ->join('imoveis', 'imoveis.idImovel = locacoes.idImovel')
                ->join('clientes', 'clientes.idClientes = locacoes.idClientes')
                ->where('locacoes_pagamentos.status', 'atrasado')
                ->findAll()
        ];

        return view('admin/relatorios/inadimplencia', $data);
    }

    public function receitas()
    {
        $dataInicio = $this->request->getGet('data_inicio') ?? date('Y-m-01');
        $dataFim = $this->request->getGet('data_fim') ?? date('Y-m-t');

        $data = [
            'titulo' => 'Relatório de Receitas',
            'receitas' => $this->pagamentoModel
                ->select('
                    locacoes_pagamentos.*, 
                    imoveis.titulo as imovel, 
                    clientes.nomeCliente as cliente,
                    SUM(valorTotal) as total_recebido
                ')
                ->join('locacoes', 'locacoes.idLocacao = locacoes_pagamentos.idLocacao')
                ->join('imoveis', 'imoveis.idImovel = locacoes.idImovel')
                ->join('clientes', 'clientes.idClientes = locacoes.idClientes')
                ->where('locacoes_pagamentos.dataPagamento >=', $dataInicio)
                ->where('locacoes_pagamentos.dataPagamento <=', $dataFim)
                ->where('locacoes_pagamentos.status', 'pago')
                ->groupBy('MONTH(dataPagamento)')
                ->findAll(),
            'data_inicio' => $dataInicio,
            'data_fim' => $dataFim
        ];

        return view('admin/relatorios/receitas', $data);
    }

    public function comissoes()
    {
        $dataInicio = $this->request->getGet('data_inicio') ?? date('Y-m-01');
        $dataFim = $this->request->getGet('data_fim') ?? date('Y-m-t');
        
        $data = [
            'titulo' => 'Relatório de Comissões',
            'data_inicio' => $dataInicio,
            'data_fim' => $dataFim,
            'comissoes_por_corretor' => $this->comissaoModel
                ->select('
                    corretores.idCorretor,
                    usuarios.nome as corretor,
                    corretores.creci,
                    COUNT(vendas.idVenda) as total_vendas,
                    SUM(vendas.valor) as valor_vendas,
                    SUM(comissoes.valor) as valor_comissoes,
                    COUNT(CASE WHEN comissoes.status = "Pendente" THEN 1 END) as comissoes_pendentes
                ')
                ->join('vendas', 'vendas.idVenda = comissoes.idVenda')
                ->join('corretores', 'corretores.idCorretor = vendas.idCorretor')
                ->join('usuarios', 'usuarios.idUsuarios = corretores.idUsuario')
                ->where('vendas.dataVenda >=', $dataInicio)
                ->where('vendas.dataVenda <=', $dataFim)
                ->groupBy('corretores.idCorretor')
                ->findAll()
        ];

        return view('admin/relatorios/comissoes', $data);
    }
}
