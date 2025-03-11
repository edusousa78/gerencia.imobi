<?php

namespace App\Models;

use CodeIgniter\Model;

class CorretorModel extends Model
{
    protected $table = 'corretores';
    protected $primaryKey = 'idCorretor';
    protected $allowedFields = [
        'idUsuario',
        'creci',
        'telefone',
        'status'
    ];

    protected $useTimestamps = false;

    public function usuario()
    {
        return $this->belongsTo('App\Models\UsuarioModel', 'idUsuario', 'idUsuarios');
    }

    public function imoveis()
    {
        return $this->hasMany('App\Models\ImovelModel', 'idCorretor', 'idCorretor');
    }
}
