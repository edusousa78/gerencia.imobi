<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissaoModel extends Model
{
    protected $table = 'permissoes';
    protected $primaryKey = 'idPermissao';
    protected $allowedFields = [
        'nome',
        'permissoes',
        'situacao',
        'data'
    ];

    protected $useTimestamps = false;

    public function verificarPermissao($idPermissao, $permissao) 
    {
        $registro = $this->find($idPermissao);
        if (!$registro) {
            return false;
        }

        $permissoes = unserialize($registro['permissoes']);
        return isset($permissoes[$permissao]) && $permissoes[$permissao] == '1';
    }
}
