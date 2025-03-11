<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentoModel extends Model
{
    protected $table = 'documentos';
    protected $primaryKey = 'idDocumento';
    protected $allowedFields = [
        'tipo',
        'idReferencia',
        'tipoReferencia',
        'nomeArquivo',
        'descricao',
        'dataCadastro',
        'idUsuario'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'dataCadastro';
}
