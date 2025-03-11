<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CorretorModel;
use App\Models\UsuarioModel;

class CorretoresController extends BaseController
{
    protected $corretorModel;
    protected $usuarioModel;
    protected $db;

    public function __construct()
    {
        $this->corretorModel = new CorretorModel();
        $this->usuarioModel = new UsuarioModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'titulo' => 'Gerenciar Corretores',
            'corretores' => $this->corretorModel
                ->select('corretores.*, usuarios.nome, usuarios.email')
                ->join('usuarios', 'usuarios.idUsuarios = corretores.idUsuario')
                ->findAll()
        ];
        
        return view('admin/corretores/index', $data);
    }

    public function novo()
    {
        $data = [
            'titulo' => 'Novo Corretor'
        ];
        
        return view('admin/corretores/form', $data);
    }

    public function criar()
    {
        $dados = $this->request->getPost();
        
        $this->db->transStart();
        
        // Criar usuário primeiro
        $dadosUsuario = [
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'senha' => password_hash($dados['senha'], PASSWORD_DEFAULT),
            'telefone' => $dados['telefone'],
            'situacao' => 1,
            'dataCadastro' => date('Y-m-d'),
            'permissoes_id' => 2 // ID da permissão de corretor
        ];
        
        $idUsuario = $this->usuarioModel->insert($dadosUsuario);
        
        // Criar corretor
        $dadosCorretor = [
            'idUsuario' => $idUsuario,
            'creci' => $dados['creci'],
            'telefone' => $dados['telefone'],
            'status' => 'ativo'
        ];
        
        $this->corretorModel->insert($dadosCorretor);
        
        $this->db->transComplete();
        
        if ($this->db->transStatus() === false) {
            return redirect()->back()->with('error', 'Erro ao cadastrar corretor');
        }
        
        return redirect()->to('/admin/corretores')->with('success', 'Corretor cadastrado com sucesso');
    }

    public function dashboard($idCorretor)
    {
        $mes = $this->request->getGet('mes') ?? date('m');
        $ano = $this->request->getGet('ano') ?? date('Y');
        
        $data = [
            'titulo' => 'Dashboard do Corretor',
            'corretor' => $this->corretorModel
                ->select('corretores.*, usuarios.nome, usuarios.email')
                ->join('usuarios', 'usuarios.idUsuarios = corretores.idUsuario')
                ->find($idCorretor),
            'desempenho' => $this->desempenhoModel
                ->where('idCorretor', $idCorretor)
                ->where('mes', $mes)
                ->where('ano', $ano)
                ->first(),
            'metas' => $this->metaModel->getMetasCorretor($idCorretor, $ano),
            'vendas_recentes' => $this->vendaModel
                ->where('idCorretor', $idCorretor)
                ->orderBy('dataVenda', 'DESC')
                ->limit(5)
                ->find(),
            'mes' => $mes,
            'ano' => $ano
        ];
        
        return view('admin/corretores/dashboard', $data);
    }

    public function ranking()
    {
        $mes = $this->request->getGet('mes') ?? date('m');
        $ano = $this->request->getGet('ano') ?? date('Y');
        
        $data = [
            'titulo' => 'Ranking de Corretores',
            'ranking' => $this->desempenhoModel
                ->select('corretores_desempenho.*, usuarios.nome as corretor')
                ->join('corretores', 'corretores.idCorretor = corretores_desempenho.idCorretor')
                ->join('usuarios', 'usuarios.idUsuarios = corretores.idUsuario')
                ->where('mes', $mes)
                ->where('ano', $ano)
                ->orderBy('pontuacao', 'DESC')
                ->findAll(),
            'mes' => $mes,
            'ano' => $ano
        ];
        
        return view('admin/corretores/ranking', $data);
    }
}
