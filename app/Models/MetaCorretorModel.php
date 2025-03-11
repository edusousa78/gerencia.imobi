<?php

namespace App\Models;

use CodeIgniter\Model;

class MetaCorretorModel extends Model
{
    protected $table = 'metas_corretores';
    protected $primaryKey = 'idMeta';
    protected $allowedFields = [
        'idCorretor',
        'mes',
        'ano',
        'valorMeta',
        'valorAlcancado',
        'status',
        'observacoes'
    ];

    protected $useTimestamps = false;

    public function getMetasCorretor($idCorretor, $ano = null)
    {
        $ano = $ano ?? date('Y');
        return $this->where('idCorretor', $idCorretor)
                    ->where('ano', $ano)
                    ->findAll();
    }
}
