<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PagamentoModel;
use App\Models\ConfiguracaoModel;
use App\Libraries\PDFGenerator;

class RecibosController extends BaseController
{
    protected $pagamentoModel;
    protected $configuracaoModel;

    public function __construct()
    {
        $this->pagamentoModel = new PagamentoModel();
        $this->configuracaoModel = new ConfiguracaoModel();
    }

    public function gerar($idPagamento)
    {
        $pagamento = $this->pagamentoModel
            ->select('locacoes_pagamentos.*, locacoes.*, imoveis.titulo as imovel, clientes.nomeCliente, clientes.documento')
            ->join('locacoes', 'locacoes.idLocacao = locacoes_pagamentos.idLocacao')
            ->join('imoveis', 'imoveis.idImovel = locacoes.idImovel')
            ->join('clientes', 'clientes.idClientes = locacoes.idClientes')
            ->find($idPagamento);

        if (!$pagamento) {
            return redirect()->back()->with('error', 'Pagamento não encontrado');
        }

        $pdf = new PDFGenerator();
        $pdf->AddPage();
        
        // Cabeçalho do recibo
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'RECIBO DE PAGAMENTO', 0, 1, 'C');
        
        // Dados do pagamento
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, 'Valor: R$ ' . number_format($pagamento['valorTotal'], 2, ',', '.'), 0, 1);
        $pdf->Cell(0, 10, 'Data: ' . date('d/m/Y', strtotime($pagamento['dataPagamento'])), 0, 1);
        
        return $this->response->download('recibo_' . $idPagamento . '.pdf', $pdf->Output('', 'S'));
    }
}
