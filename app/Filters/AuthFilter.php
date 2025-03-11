<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Registra o acesso
        $db = \Config\Database::connect();
        $db->table('acessos_sistema')->insert([
            'idUsuarios' => session()->get('id'),
            'ip' => $request->getIPAddress(),
            'dataHora' => date('Y-m-d H:i:s'),
            'sucesso' => 1
        ]);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
