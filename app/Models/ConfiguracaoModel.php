<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfiguracaoModel extends Model
{
    protected $table = 'configuracoes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['chave', 'valor', 'descricao', 'grupo'];

    public function getAll()
    {
        $configs = $this->findAll();
        $result = [];
        
        foreach ($configs as $config) {
            $result[$config['chave']] = $config['valor'];
        }
        
        return $result;
    }

    public function setConfig($chave, $valor, $grupo = 'empresa')
    {
        $config = $this->where('chave', $chave)->first();
        
        if ($config) {
            return $this->update($config['id'], [
                'valor' => $valor,
                'grupo' => $grupo
            ]);
        }
        
        return $this->insert([
            'chave' => $chave,
            'valor' => $valor,
            'grupo' => $grupo
        ]);
    }
}
