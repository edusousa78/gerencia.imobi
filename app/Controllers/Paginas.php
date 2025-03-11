<?php

namespace App\Controllers;

use App\Models\ConfiguracaoModel;

class Paginas extends BaseController
{
    protected $configuracaoModel;

    public function __construct()
    {
        $this->configuracaoModel = new ConfiguracaoModel();
    }

    public function sobre()
    {
        $data = [
            'titulo' => 'Sobre Nós',
            'configuracoes' => $this->configuracaoModel->getAll()
        ];

        return view('site/sobre', $data);
    }

    public function contato()
    {
        $data = [
            'titulo' => 'Contato',
            'configuracoes' => $this->configuracaoModel->getAll()
        ];

        return view('site/contato', $data);
    }
}
