<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ImovelModel;
use App\Models\ClienteModel;
use App\Models\VendaModel;

class VendasController extends BaseController
{
    protected $imovelModel;
    protected $clienteModel;
    protected $vendaModel;

    public function __construct()
    {
        $this->imovelModel = new ImovelModel();
        $this->clienteModel = new ClienteModel();
        $this->vendaModel = new VendaModel();
    }

    public function index()
    {
        $data = [
            'titulo' => 'Gerenciar Vendas',
            'vendas' => $this->vendaModel->select('vendas.*, imoveis.titulo as imovel, clientes.nomeCliente as cliente')
                                       ->join('imoveis', 'imoveis.idImovel = vendas.idImovel')
                                       ->join('clientes', 'clientes.idClientes = vendas.idCliente')
                                       ->findAll()
        ];

        return view('admin/vendas/index', $data);
    }

    public function nova()
    {
        $data = [
            'titulo' => 'Nova Venda',
            'imoveis' => $this->imovelModel->where('status', 'disponível')->findAll(),
            'clientes' => $this->clienteModel->where('status', 'Ativo')->findAll()
        ];

        return view('admin/vendas/form', $data);
    }

    public function criar()
    {
        // Implementar lógica de criação
    }

    public function comissoes($idVenda)
    {
        $db = \Config\Database::connect();
        
        $query = $db->query("
            SELECT c.*, v.valor as valorVenda, cor.nome as corretor, cor.creci
            FROM comissoes c
            JOIN vendas v ON v.idVenda = c.idVenda 
            JOIN corretores cor ON cor.idCorretor = v.idCorretor
            WHERE c.idVenda = ?
        ", [$idVenda]);

        $data = [
            'titulo' => 'Comissões da Venda',
            'comissoes' => $query->getResult(),
            'venda' => $this->vendaModel->find($idVenda)
        ];

        return view('admin/vendas/comissoes', $data);
    }

    public function relatorioComissoes()
    {
        $db = \Config\Database::connect();
        
        $query = $db->query("
            SELECT 
                cor.nome as corretor,
                cor.creci,
                COUNT(v.idVenda) as total_vendas,
                SUM(v.valor) as valor_vendas,
                SUM(c.valor) as valor_comissoes,
                AVG(c.percentual) as media_percentual
            FROM corretores cor
            LEFT JOIN vendas v ON v.idCorretor = cor.idCorretor
            LEFT JOIN comissoes c ON c.idVenda = v.idVenda
            WHERE v.dataVenda BETWEEN ? AND ?
            GROUP BY cor.idCorretor
        ", [date('Y-m-01'), date('Y-m-t')]);

        $data = [
            'titulo' => 'Relatório de Comissões',
            'resultados' => $query->getResult()
        ];

        return view('admin/vendas/relatorio_comissoes', $data);
    }
}
