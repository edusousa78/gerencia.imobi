<?php

namespace App\Models;

use CodeIgniter\Model;

class OcorrenciaModel extends Model
{
    protected $table = 'locacoes_ocorrencias';
    protected $primaryKey = 'idOcorrencia';
    protected $allowedFields = [
        'idLocacao',
        'data',
        'tipo',
        'descricao',
        'status'
    ];
    
    protected $useTimestamps = false;
}
