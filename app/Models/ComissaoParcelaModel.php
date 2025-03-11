<?php

namespace App\Models;

use CodeIgniter\Model;

class ComissaoParcelaModel extends Model
{
    protected $table = 'comissoes_parcelas';
    protected $primaryKey = 'idParcela';
    protected $allowedFields = [
        'idComissao',
        'numeroParcela',
        'valor',
        'vencimento',
        'dataPagamento',
        'status'
    ];

    protected $useTimestamps = false;

    public function comissao()
    {
        return $this->belongsTo('App\Models\ComissaoModel', 'idComissao', 'idComissao');
    }
}
