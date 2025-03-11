<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PermissaoModel;

class PermissionFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Mapeia as rotas para as permissões necessárias
        $permissoesRotas = [
            'admin/usuarios' => 'cUsuario',
            'admin/permissoes' => 'cPermissao',
            'admin/clientes' => ['aCliente', 'eCliente', 'dCliente', 'vCliente'],
            'admin/imoveis' => ['aImovel', 'eImovel', 'dImovel', 'vImovel'],
            'admin/locacoes' => ['aLocacao', 'eLocacao', 'dLocacao', 'vLocacao'],
            'admin/vendas' => ['aVenda', 'eVenda', 'dVenda', 'vVenda']
        ];

        // Forma correta de obter o path da URI
        $uri = $request->getUri()->getPath();
        
        $permissaoModel = new PermissaoModel();
        $idPermissao = $session->get('permissoes_id');

        // Verifica se a rota precisa de permissão
        foreach ($permissoesRotas as $rota => $permissoesNecessarias) {
            if (strpos($uri, $rota) === 0) {
                if (!is_array($permissoesNecessarias)) {
                    $permissoesNecessarias = [$permissoesNecessarias];
                }

                // Verifica se tem pelo menos uma das permissões necessárias
                foreach ($permissoesNecessarias as $permissao) {
                    if ($permissaoModel->verificarPermissao($idPermissao, $permissao)) {
                        return;
                    }
                }

                return redirect()->back()->with('error', 'Acesso não autorizado');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
