<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class FinanceiroController extends BaseController
{
    public function index()
    {
        $data = [
            'titulo' => 'Gestão Financeira',
            'saldo_atual' => $this->calcularSaldoAtual(),
            'receitas_mes' => $this->getReceitasMes(),
            'despesas_mes' => $this->getDespesasMes(),
            'contas_receber' => $this->getContasReceber(),
            'contas_pagar' => $this->getContasPagar()
        ];

        return view('admin/financeiro/index', $data);
    }

    // ...remaining methods...
}
