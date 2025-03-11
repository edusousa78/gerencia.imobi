<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificacaoModel extends Model
{
    protected $table = 'notificacoes';
    protected $primaryKey = 'idNotificacao';
    protected $allowedFields = [
        'tipo',
        'titulo',
        'mensagem',
        'idUsuario',
        'lida',
        'data',
        'link'
    ];

    protected $useTimestamps = false;

    public function getNotificacoesNaoLidas($idUsuario)
    {
        return $this->where('idUsuario', $idUsuario)
                    ->where('lida', 0)
                    ->orderBy('data', 'DESC')
                    ->findAll();
    }
}
