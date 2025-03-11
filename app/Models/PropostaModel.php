<?php

namespace App\Models;

use CodeIgniter\Model;

class PropostaModel extends Model
{
    protected $table = 'propostas';
    protected $primaryKey = 'idProposta';
    protected $allowedFields = [
        'idImovel',
        'idCliente',
        'idCorretor',
        'tipo', // compra ou locacao
        'valor',
        'dataProposta',
        'status', // em_analise, aprovada, recusada, cancelada
        'observacoes',
        'condicoesPagamento',
        'dataValidade'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
