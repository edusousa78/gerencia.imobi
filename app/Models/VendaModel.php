<?php

namespace App\Models;

use CodeIgniter\Model;

class VendaModel extends Model
{
    protected $table = 'vendas';
    protected $primaryKey = 'idVenda';
    protected $allowedFields = [
        'idImovel',
        'idCliente',
        'valor',
        'dataVenda',
        'formaPagamento',
        'status',
        'observacoes'
    ];

    protected $useTimestamps = false;

    public function imovel()
    {
        return $this->belongsTo('App\Models\ImovelModel', 'idImovel', 'idImovel');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Models\ClienteModel', 'idCliente', 'idClientes');
    }
}
