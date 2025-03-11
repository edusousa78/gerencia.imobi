<?php

namespace App\Models;

use CodeIgniter\Model;

class PagamentoModel extends Model
{
    protected $table = 'locacoes_pagamentos';
    protected $primaryKey = 'idPagamento';
    protected $allowedFields = [
        'idLocacao',
        'competencia',
        'vencimento',
        'dataPagamento',
        'valorAluguel',
        'valorCondominio',
        'valorIPTU',
        'valorMulta',
        'valorJuros',
        'valorTotal',
        'status'
    ];
}
