<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'idClientes';
    protected $allowedFields = [
        'nomeCliente',
        'tipo',
        'tipo_cliente',
        'documento',
        'inscEstadual',
        'telefone',
        'telefone2',
        'data_nascimento',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'status',
        'email',
        'observacoes',
        'dataCadastro'
    ];

    public function getLocatarios()
    {
        return $this->where('tipo_cliente', 'locatario')
                    ->where('status', 'Ativo')
                    ->orderBy('nomeCliente', 'ASC')
                    ->findAll();
    }

    public function getLocadores()
    {
        return $this->where('tipo_cliente', 'locador')
                    ->where('status', 'Ativo')
                    ->orderBy('nomeCliente', 'ASC')
                    ->findAll();
    }
}
