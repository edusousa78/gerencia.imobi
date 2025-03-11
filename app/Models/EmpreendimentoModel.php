<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpreendimentoModel extends Model
{
    protected $table = 'empreendimentos';
    protected $primaryKey = 'idEmpreendimento';
    protected $allowedFields = [
        'nome',
        'tipo',
        'status',
        'valorMedio',
        'numUnidades',
        'areaTotal',
        'cidade',
        'estado',
        'dataCadastro'
    ];

    public function midias()
    {
        return $this->hasMany('App\Models\EmpreendimentoMidiaModel', 'idEmpreendimento', 'idEmpreendimento');
    }

    public function imoveis()
    {
        return $this->hasMany('App\Models\ImovelModel', 'idEmpreendimento', 'idEmpreendimento');
    }
}
