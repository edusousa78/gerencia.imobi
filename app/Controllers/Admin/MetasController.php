<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MetaCorretorModel;
use App\Models\CorretorModel;
use App\Models\VendaModel;

class MetasController extends BaseController
{
    protected $metaModel;
    protected $corretorModel;
    protected $vendaModel;

    public function __construct()
    {
        $this->metaModel = new MetaCorretorModel();
        $this->corretorModel = new CorretorModel();
        $this->vendaModel = new VendaModel();
    }

    public function index()
    {
        $ano = $this->request->getGet('ano') ?? date('Y');
        
        $data = [
            'titulo' => 'Metas de Vendas',
            'corretores' => $this->corretorModel->select('corretores.*, usuarios.nome')
                                              ->join('usuarios', 'usuarios.idUsuarios = corretores.idUsuario')
                                              ->findAll(),
            'metas' => $this->metaModel->where('ano', $ano)->findAll(),
            'ano' => $ano
        ];

        return view('admin/metas/index', $data);
    }

    public function definirMeta()
    {
        $post = $this->request->getPost();
        
        $data = [
            'idCorretor' => $post['idCorretor'],
            'mes' => $post['mes'],
            'ano' => $post['ano'],
            'valorMeta' => str_replace(['.', ','], ['', '.'], $post['valorMeta']),
            'status' => 'Em Andamento'
        ];

        $this->metaModel->insert($data);
        return redirect()->back()->with('success', 'Meta definida com sucesso');
    }

    public function acompanhamento($idCorretor)
    {
        $ano = $this->request->getGet('ano') ?? date('Y');
        $mes = $this->request->getGet('mes') ?? date('m');
        
        $corretor = $this->corretorModel
            ->select('corretores.*, usuarios.nome, usuarios.email')
            ->join('usuarios', 'usuarios.idUsuarios = corretores.idUsuario')
            ->find($idCorretor);
            
        $meta = $this->metaModel
            ->where('idCorretor', $idCorretor)
            ->where('mes', $mes)
            ->where('ano', $ano)
            ->first();
            
        $vendas = $this->vendaModel
            ->where('idCorretor', $idCorretor)
            ->where('MONTH(dataVenda)', $mes)
            ->where('YEAR(dataVenda)', $ano)
            ->findAll();
            
        $valorVendas = array_sum(array_column($vendas, 'valor'));
        
        if ($meta) {
            $percentualAlcancado = ($valorVendas / $meta['valorMeta']) * 100;
            
            // Atualiza o valor alcançado
            $this->metaModel->update($meta['idMeta'], [
                'valorAlcancado' => $valorVendas,
                'status' => $percentualAlcancado >= 100 ? 'Concluída' : 'Em Andamento'
            ]);
        }
        
        $data = [
            'titulo' => 'Acompanhamento de Metas',
            'corretor' => $corretor,
            'meta' => $meta,
            'vendas' => $vendas,
            'valorVendas' => $valorVendas,
            'mes' => $mes,
            'ano' => $ano
        ];
        
        return view('admin/metas/acompanhamento', $data);
    }
}
