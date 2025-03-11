<?php

namespace App\Models;

use CodeIgniter\Model;

class ComissaoModel extends Model
{
    protected $table = 'comissoes';
    protected $primaryKey = 'idComissao';
    protected $allowedFields = [
        'idVenda',
        'valor',
        'percentual',
        'dataVencimento',
        'dataPagamento',
        'status',
        'formaPagamento',
        'comprovante',
        'observacoes'
    ];

    public function parcelas()
    {
        return $this->hasMany('App\Models\ComissaoParcelaModel', 'idComissao', 'idComissao');
    }

    public function venda()
    {
        return $this->belongsTo('App\Models\VendaModel', 'idVenda', 'idVenda');
    }
}
