<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ConfiguracoesController extends BaseController
{
    public function index()
    {
        $data = [
            'titulo' => 'Configurações do Sistema',
            'config' => config('Imobiliaria')
        ];
        
        return view('admin/configuracoes/index', $data);
    }

    public function salvar()
    {
        // Lógica para salvar configurações
    }
}
