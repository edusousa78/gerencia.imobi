<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LocacaoModel;
use App\Models\ImovelModel;
use App\Models\ClienteModel;

class LocacoesController extends BaseController
{
    protected $locacaoModel;
    protected $imovelModel;
    protected $clienteModel;

    public function __construct()
    {
        $this->locacaoModel = new LocacaoModel();
        $this->imovelModel = new ImovelModel();
        $this->clienteModel = new ClienteModel();
    }

    public function index()
    {
        $data = [
            'titulo' => 'Gerenciar Locações',
            'locacoes' => $this->locacaoModel->getLocacoes()
        ];

        return view('admin/locacoes/index', $data);
    }
}