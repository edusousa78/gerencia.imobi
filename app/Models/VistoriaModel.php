<?php

namespace App\Models;

use CodeIgniter\Model;

class VistoriaModel extends Model
{
    protected $table = 'locacoes_vistorias';
    protected $primaryKey = 'idVistoria';
    protected $allowedFields = [
        'idLocacao',
        'tipo',
        'data',
        'observacoes'
    ];

    public function itens()
    {
        return $this->hasMany('App\Models\VistoriaItemModel', 'idVistoria', 'idVistoria');
    }
}
