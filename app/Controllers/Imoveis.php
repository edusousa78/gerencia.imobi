<?php

namespace App\Controllers;

use App\Models\ImovelModel;
use App\Models\ImovelMidiaModel;
use App\Models\ConfiguracaoModel;

class Imoveis extends BaseController
{
    protected $imovelModel;
    protected $midiaModel;
    protected $configuracaoModel;

    public function __construct()
    {
        $this->imovelModel = new ImovelModel();
        $this->midiaModel = new ImovelMidiaModel();
        $this->configuracaoModel = new ConfiguracaoModel();
    }

    public function index()
    {
        $tipo = $this->request->getGet('tipo');
        $cidade = $this->request->getGet('cidade');
        
        $query = $this->imovelModel->where('status', 'disponível');
        
        if ($tipo) {
            $query->where('tipo', $tipo);
        }
        if ($cidade) {
            $query->like('cidade', $cidade, 'both');
        }

        $data = [
            'titulo' => 'Imóveis',
            'configuracoes' => $this->configuracaoModel->getAll(),
            'imoveis' => $query->findAll()
        ];

        return view('site/imoveis/index', $data);
    }

    public function detalhes($id)
    {
        $imovel = $this->imovelModel->find($id);
        
        if (!$imovel) {
            return redirect()->to('/imoveis');
        }

        $data = [
            'titulo' => $imovel['titulo'],
            'configuracoes' => $this->configuracaoModel->getAll(),
            'imovel' => $imovel,
            'fotos' => $this->midiaModel->where('idImovel', $id)->findAll()
        ];

        return view('site/imoveis/detalhes', $data);
    }
}
