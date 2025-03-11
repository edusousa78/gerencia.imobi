<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NotificacaoModel;

class NotificacoesController extends BaseController
{
    protected $notificacaoModel;

    public function __construct()
    {
        $this->notificacaoModel = new NotificacaoModel();
    }

    public function listar()
    {
        $usuario = session()->get('usuario');
        
        $data = [
            'titulo' => 'Notificações',
            'notificacoes' => $this->notificacaoModel
                ->where('idUsuario', $usuario['idUsuarios'])
                ->orderBy('data', 'DESC')
                ->findAll()
        ];

        return view('admin/notificacoes/listar', $data);
    }

    public function marcarLida($id)
    {
        $this->notificacaoModel->update($id, ['lida' => 1]);
        return $this->response->setJSON(['success' => true]);
    }
}
