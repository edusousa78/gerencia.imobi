<?php

namespace App\Models;

use CodeIgniter\Model;

class ImovelMidiaModel extends Model
{
    protected $table = 'imoveis_midias';
    protected $primaryKey = 'idMidia';
    protected $allowedFields = [
        'idImovel',
        'tipo',
        'url',
        'ordem',
        'thumbnail'
    ];

    protected $useTimestamps = false;
}
