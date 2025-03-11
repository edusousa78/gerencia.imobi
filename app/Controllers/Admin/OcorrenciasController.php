<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OcorrenciaModel;
use App\Models\LocacaoModel;

class OcorrenciasController extends BaseController
{
    protected $ocorrenciaModel;
    protected $locacaoModel;

    public function __construct()
    {
        $this->ocorrenciaModel = new OcorrenciaModel();
        $this->locacaoModel = new LocacaoModel();
    }

    public function index($idLocacao)
    {
        $data = [
            'titulo' => 'Ocorrências',
            'locacao' => $this->locacaoModel->find($idLocacao),
            'ocorrencias' => $this->ocorrenciaModel->where('idLocacao', $idLocacao)->findAll()
        ];
        
        return view('admin/ocorrencias/index', $data);
    }
}
