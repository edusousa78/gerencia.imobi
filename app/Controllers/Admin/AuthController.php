<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class AuthController extends BaseController
{
    protected $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
    }

    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('admin/dashboard');
        }
        return view('admin/auth/login');
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');

        $usuario = $this->usuarioModel->where('email', $email)->first();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $sessao = [
                'id' => $usuario['idUsuarios'],
                'nome' => $usuario['nome'],
                'email' => $usuario['email'],
                'permissoes_id' => $usuario['permissoes_id'],
                'logged_in' => true
            ];

            session()->set($sessao);

            // Registra o acesso
            $this->registrarAcesso($usuario['idUsuarios'], true);

            return redirect()->to('/admin/dashboard');
        }

        $this->registrarAcesso(null, false, $email);
        return redirect()->back()->with('error', 'Email ou senha inválidos');
    }

    private function registrarAcesso($idUsuario, $sucesso, $email = null)
    {
        $db = \Config\Database::connect();
        
        $dados = [
            'idUsuarios' => $idUsuario,
            'ip' => $this->request->getIPAddress(),
            'sucesso' => $sucesso,
            'observacao' => $sucesso ? null : "Tentativa de login: {$email}",
            'dataHora' => date('Y-m-d H:i:s')
        ];

        $db->table('acessos_sistema')->insert($dados);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Logout realizado com sucesso');
    }
}
