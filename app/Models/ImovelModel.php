<?php

namespace App\Models;

use CodeIgniter\Model;

class ImovelModel extends Model
{
    protected $table = 'imoveis';
    protected $primaryKey = 'idImovel';
    protected $allowedFields = [
        'idEmpreendimento',
        'titulo',
        'descricao',
        'tipo',
        'metragem',
        'quartos',
        'banheiros',
        'vagas',
        'valor',
        'status',
        'endereco',
        'cidade',
        'estado'
    ];

    // Desabilitar timestamps pois não temos essas colunas
    protected $useTimestamps = false;
    
    // Relacionamentos
    public function midias()
    {
        return $this->hasMany('App\Models\ImovelMidiaModel', 'idImovel', 'idImovel');
    }

    public function empreendimento()
    {
        return $this->belongsTo('App\Models\EmpreendimentoModel', 'idEmpreendimento', 'idEmpreendimento');
    }
}
