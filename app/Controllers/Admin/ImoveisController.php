<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ImovelModel;
use App\Models\EmpreendimentoModel;
use App\Models\ImovelMidiaModel;

class ImoveisController extends BaseController
{
    protected $imovelModel;
    protected $empreendimentoModel;
    protected $midiaModel;

    public function __construct()
    {
        $this->imovelModel = new ImovelModel();
        $this->empreendimentoModel = new EmpreendimentoModel();
        $this->midiaModel = new ImovelMidiaModel();
    }

    public function index()
    {
        $data = [
            'titulo' => 'Gestão de Imóveis',
            'imoveis' => $this->imovelModel
                ->select('imoveis.*, midia.url as foto_capa')
                ->join('imoveis_midias midia', 'midia.idImovel = imoveis.idImovel AND midia.thumbnail = 1', 'left')
                ->findAll()
        ];

        return view('admin/imoveis/index', $data);
    }

    public function novo()
    {
        $data = [
            'titulo' => 'Novo Imóvel',
            'empreendimentos' => $this->empreendimentoModel->findAll(),
            'estados' => [
                'AC' => 'Acre',
                'AL' => 'Alagoas',
                'AP' => 'Amapá',
                'AM' => 'Amazonas',
                'BA' => 'Bahia',
                'CE' => 'Ceará',
                'DF' => 'Distrito Federal',
                'ES' => 'Espírito Santo',
                'GO' => 'Goiás',
                'MA' => 'Maranhão',
                'MT' => 'Mato Grosso',
                'MS' => 'Mato Grosso do Sul',
                'MG' => 'Minas Gerais',
                'PA' => 'Pará',
                'PB' => 'Paraíba',
                'PR' => 'Paraná',
                'PE' => 'Pernambuco',
                'PI' => 'Piauí',
                'RJ' => 'Rio de Janeiro',
                'RN' => 'Rio Grande do Norte',
                'RS' => 'Rio Grande do Sul',
                'RO' => 'Rondônia',
                'RR' => 'Roraima',
                'SC' => 'Santa Catarina',
                'SP' => 'São Paulo',
                'SE' => 'Sergipe',
                'TO' => 'Tocantins'
            ]
        ];

        return view('admin/imoveis/form', $data);
    }

    public function criar()
    {
        $dados = $this->request->getPost();
        
        if ($this->imovelModel->save($dados)) {
            return redirect()->to('/admin/imoveis')->with('success', 'Imóvel cadastrado com sucesso');
        }

        return redirect()->back()->withInput()->with('error', 'Erro ao cadastrar imóvel');
    }

    public function uploadFotos($idImovel)
    {
        $fotos = $this->request->getFiles('fotos');
        foreach ($fotos['fotos'] as $foto) {
            if ($foto->isValid() && !$foto->hasMoved()) {
                $newName = $foto->getRandomName();
                $foto->move(WRITEPATH . 'uploads/imoveis', $newName);
                
                // Salvar referência no banco
                $this->midiaModel->insert([
                    'idImovel' => $idImovel,
                    'tipo' => 'foto',
                    'url' => $newName
                ]);
            }
        }
        
        return $this->response->setJSON(['success' => true]);
    }

    public function midias($idImovel)
    {
        $data = [
            'titulo' => 'Gerenciar Fotos do Imóvel',
            'imovel' => $this->imovelModel->find($idImovel),
            'midias' => $this->midiaModel->where('idImovel', $idImovel)->findAll()
        ];

        return view('admin/imoveis/midias', $data);
    }

    public function uploadMidia($idImovel)
    {
        $fotos = $this->request->getFiles();
        foreach ($fotos['fotos'] as $foto) {
            if ($foto->isValid() && !$foto->hasMoved()) {
                $newName = $foto->getRandomName();
                // Alterado o caminho para pasta pública
                $foto->move(ROOTPATH . 'public/uploads/imoveis', $newName);
                
                $this->midiaModel->insert([
                    'idImovel' => $idImovel,
                    'tipo' => 'foto',
                    'url' => $newName,
                    'ordem' => 999
                ]);
            }
        }
        
        return redirect()->back()->with('success', 'Fotos enviadas com sucesso');
    }

    public function excluirMidia($idMidia)
    {
        $midia = $this->midiaModel->find($idMidia);
        if ($midia) {
            // Exclui arquivo físico
            unlink(WRITEPATH . 'uploads/imoveis/' . $midia['url']);
            $this->midiaModel->delete($idMidia);
        }
        
        return redirect()->back()->with('success', 'Foto excluída com sucesso');
    }

    public function definirCapa($idMidia)
    {
        $midia = $this->midiaModel->find($idMidia);
        if ($midia) {
            // Remove thumbnail atual
            $this->midiaModel->where('idImovel', $midia['idImovel'])
                            ->set(['thumbnail' => 0])
                            ->update();
            
            // Define nova thumbnail
            $this->midiaModel->update($idMidia, ['thumbnail' => 1]);
        }
        
        return redirect()->back()->with('success', 'Capa definida com sucesso');
    }

    public function detalhes($id)
    {
        $data = [
            'titulo' => 'Detalhes do Imóvel',
            'imovel' => $this->imovelModel->find($id),
            'midias' => $this->midiaModel->where('idImovel', $id)->findAll()
        ];

        if (!$data['imovel']) {
            return redirect()->back()->with('error', 'Imóvel não encontrado');
        }

        return view('admin/imoveis/detalhes', $data);
    }

    public function editar($id)
    {
        $imovel = $this->imovelModel->find($id);
        
        if (!$imovel) {
            return redirect()->back()->with('error', 'Imóvel não encontrado');
        }

        $data = [
            'titulo' => 'Editar Imóvel',
            'imovel' => $imovel,
            'empreendimentos' => $this->empreendimentoModel->findAll(),
            'estados' => [
                'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 
                'AM' => 'Amazonas', 'BA' => 'Bahia', 'CE' => 'Ceará',
                'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo',
                'GO' => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Mato Grosso',
                'MS' => 'Mato Grosso do Sul', 'MG' => 'Minas Gerais',
                'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná',
                'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro',
                'RN' => 'Rio Grande do Norte', 'RS' => 'Rio Grande do Sul',
                'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina',
                'SP' => 'São Paulo', 'SE' => 'Sergipe', 'TO' => 'Tocantins'
            ]
        ];

        return view('admin/imoveis/form', $data);
    }

    public function atualizar($id)
    {
        $dados = $this->request->getPost();
        
        // Formata o valor monetário
        if (isset($dados['valor'])) {
            $dados['valor'] = str_replace(['R$ ', '.', ','], ['', '', '.'], $dados['valor']);
        }

        if ($this->imovelModel->update($id, $dados)) {
            return redirect()->to('/admin/imoveis')->with('success', 'Imóvel atualizado com sucesso');
        }

        return redirect()->back()->withInput()->with('error', 'Erro ao atualizar imóvel');
    }
}
