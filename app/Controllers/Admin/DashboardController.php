<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ImovelModel;
use App\Models\LocacaoModel;
use App\Models\ClienteModel;
use App\Models\VendaModel;

class DashboardController extends BaseController
{
    protected $imovelModel;
    protected $locacaoModel;
    protected $clienteModel;
    protected $vendaModel;

    public function __construct()
    {
        $this->imovelModel = new ImovelModel();
        $this->locacaoModel = new LocacaoModel();
        $this->clienteModel = new ClienteModel();
        $this->vendaModel = new VendaModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        
        // Locações recentes com JOIN correto
        $locacoes = $db->query("
            SELECT l.*, i.titulo as imovel, 
                   cl.nomeCliente as locatario,
                   l.valorAluguel, l.status, l.dataInicio
            FROM locacoes l
            JOIN imoveis i ON i.idImovel = l.idImovel
            JOIN clientes_locacoes cll ON cll.idLocacao = l.idLocacao
            JOIN clientes cl ON cl.idClientes = cll.idClientes
            WHERE cll.tipo_relacao = 'locatario'
            ORDER BY l.dataInicio DESC 
            LIMIT 5
        ")->getResult();

        // Estatísticas mensais
        $stats = $db->query("
            SELECT 
                COUNT(CASE WHEN l.status = 'ativa' THEN 1 END) as locacoes_ativas,
                COUNT(CASE WHEN i.status = 'disponível' THEN 1 END) as imoveis_disponiveis,
                COUNT(CASE WHEN v.status = 'Concluída' AND MONTH(v.dataVenda) = MONTH(CURRENT_DATE()) THEN 1 END) as vendas_mes,
                SUM(CASE WHEN l.status = 'ativa' THEN l.valorAluguel ELSE 0 END) as receita_aluguel
            FROM locacoes l
            CROSS JOIN imoveis i
            LEFT JOIN vendas v ON 1=1
        ")->getRow();

        // Dados para gráficos
        $vendas_por_mes = $db->query("
            SELECT 
                MONTH(dataVenda) as mes,
                COUNT(*) as total,
                SUM(valor) as valor_total
            FROM vendas
            WHERE YEAR(dataVenda) = YEAR(CURRENT_DATE())
            GROUP BY MONTH(dataVenda)
            ORDER BY mes
        ")->getResult();

        $data = [
            'titulo' => 'Dashboard',
            'cards' => [
                'imoveis' => $this->imovelModel->countAll(),
                'locacoes' => $this->locacaoModel->countAll(),
                'clientes' => $this->clienteModel->countAll(),
                'vendas' => $this->vendaModel->countAll()
            ],
            'locacoes' => $locacoes,
            'stats' => $stats,
            'vendas_por_mes' => $vendas_por_mes
        ];

        return view('admin/dashboard/index', $data);
    }
}
