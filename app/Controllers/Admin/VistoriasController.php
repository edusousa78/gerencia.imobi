<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\VistoriaModel;
use App\Models\LocacaoModel;

class VistoriasController extends BaseController
{
    protected $vistoriaModel;
    protected $locacaoModel;

    public function __construct()
    {
        $this->vistoriaModel = new VistoriaModel();
        $this->locacaoModel = new LocacaoModel();
    }

    public function index($idLocacao)
    {
        $data = [
            'titulo' => 'Vistorias',
            'locacao' => $this->locacaoModel->find($idLocacao),
            'vistorias' => $this->vistoriaModel->where('idLocacao', $idLocacao)->findAll()
        ];
        
        return view('admin/vistorias/index', $data);
    }
}
