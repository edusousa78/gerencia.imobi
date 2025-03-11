<?php

namespace App\Models;

use CodeIgniter\Model;

class LocacaoModel extends Model
{
    protected $table = 'locacoes';
    protected $primaryKey = 'idLocacao';
    protected $allowedFields = [
        'idImovel',
        'dataInicio',
        'dataTermino',
        'valorAluguel',
        'status',
        'diaVencimento',
        'duracao'
    ];

    public function getLocacoes()
    {
        return $this->db->table('locacoes l')
            ->select('l.*, i.titulo as imovel, c_loc.nomeCliente as locador, c_locat.nomeCliente as locatario')
            ->join('imoveis i', 'i.idImovel = l.idImovel')
            ->join('clientes_locacoes cl_loc', 'cl_loc.idLocacao = l.idLocacao AND cl_loc.tipo_relacao = "locador"')
            ->join('clientes c_loc', 'c_loc.idClientes = cl_loc.idClientes')
            ->join('clientes_locacoes cl_locat', 'cl_locat.idLocacao = l.idLocacao AND cl_locat.tipo_relacao = "locatario"')
            ->join('clientes c_locat', 'c_locat.idClientes = cl_locat.idClientes')
            ->get()
            ->getResultArray();
    }
}

