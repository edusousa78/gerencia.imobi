<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'idUsuarios';
    protected $allowedFields = [
        'nome',
        'email',
        'senha',
        'telefone',
        'situacao',
        'dataCadastro',
        'permissoes_id'
    ];
    protected $useTimestamps = false;
    
    protected $beforeInsert = ['hashSenha'];
    protected $beforeUpdate = ['hashSenha'];
    
    protected function hashSenha(array $data)
    {
        if (isset($data['data']['senha'])) {
            $data['data']['senha'] = password_hash($data['data']['senha'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}
