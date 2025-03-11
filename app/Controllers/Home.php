<?php

namespace App\Controllers;

use App\Models\ImovelModel;
use App\Models\EmpreendimentoModel;
use App\Models\ConfiguracaoModel;

class Home extends BaseController
{
    protected $imovelModel;
    protected $empreendimentoModel;
    protected $configuracaoModel;

    public function __construct()
    {
        $this->imovelModel = new ImovelModel();
        $this->empreendimentoModel = new EmpreendimentoModel();
        $this->configuracaoModel = new ConfiguracaoModel();
    }

    public function index()
    {
        $data = [
            'titulo' => 'Início',
            'configuracoes' => $this->configuracaoModel->getAll(),
            'destaques' => $this->imovelModel->where('status', 'disponível')
                                          ->orderBy('dataCadastro', 'DESC')
                                          ->limit(6)
                                          ->find(),
            'lancamentos' => $this->empreendimentoModel->where('status', 'lançamento')
                                                    ->limit(3)
                                                    ->find()
        ];

        return view('site/home', $data);
    }
}
