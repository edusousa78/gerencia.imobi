<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ComissaoModel;
use App\Models\VendaModel;

class ComissoesController extends BaseController
{
    protected $comissaoModel;
    protected $vendaModel;

    public function __construct()
    {
        $this->comissaoModel = new ComissaoModel();
        $this->vendaModel = new VendaModel();
    }

    public function index()
    {
        $data = [
            'titulo' => 'Gestão de Comissões',
            'comissoes' => $this->comissaoModel
                ->select('comissoes.*, vendas.valor as valorVenda, corretores.nome as corretor')
                ->join('vendas', 'vendas.idVenda = comissoes.idVenda')
                ->join('corretores', 'corretores.idCorretor = vendas.idCorretor')
                ->findAll()
        ];

        return view('admin/comissoes/index', $data);
    }

    public function gerar($idVenda)
    {
        $venda = $this->vendaModel->find($idVenda);
        
        // Calcula comissão baseada no percentual da venda
        $valorComissao = ($venda['valor'] * $venda['percentualComissao']) / 100;
        
        $dados = [
            'idVenda' => $idVenda,
            'valor' => $valorComissao,
            'percentual' => $venda['percentualComissao'],
            'dataVencimento' => date('Y-m-d', strtotime('+30 days')),
            'status' => 'Pendente'
        ];
        
        $this->comissaoModel->insert($dados);
        return redirect()->to('/admin/comissoes')->with('success', 'Comissão gerada com sucesso');
    }

    public function parcelar($idComissao)
    {
        $comissao = $this->comissaoModel->find($idComissao);
        
        if (!$comissao) {
            return redirect()->back()->with('error', 'Comissão não encontrada');
        }
        
        $numParcelas = $this->request->getPost('num_parcelas');
        $valorParcela = $comissao['valor'] / $numParcelas;
        
        $this->db->transStart();
        
        for ($i = 1; $i <= $numParcelas; $i++) {
            $vencimento = date('Y-m-d', strtotime("+{$i} month"));
            
            $this->comissaoParcelaModel->insert([
                'idComissao' => $idComissao,
                'numeroParcela' => $i,
                'valor' => $valorParcela,
                'vencimento' => $vencimento,
                'status' => 'Pendente'
            ]);
        }
        
        $this->comissaoModel->update($idComissao, ['status' => 'Parcelado']);
        
        $this->db->transComplete();
        
        if ($this->db->transStatus() === false) {
            return redirect()->back()->with('error', 'Erro ao parcelar comissão');
        }
        
        return redirect()->to('/admin/comissoes')->with('success', 'Comissão parcelada com sucesso');
    }

    public function pagarParcela()
    {
        $idParcela = $this->request->getPost('idParcela');
        $dataPagamento = $this->request->getPost('dataPagamento');
        
        $parcela = $this->comissaoParcelaModel->find($idParcela);
        if (!$parcela) {
            return redirect()->back()->with('error', 'Parcela não encontrada');
        }
        
        $this->comissaoParcelaModel->update($idParcela, [
            'dataPagamento' => $dataPagamento,
            'status' => 'Pago'
        ]);
        
        // Verifica se todas as parcelas foram pagas
        $parcelasPendentes = $this->comissaoParcelaModel
            ->where('idComissao', $parcela['idComissao'])
            ->where('status !=', 'Pago')
            ->countAllResults();
            
        if ($parcelasPendentes == 0) {
            $this->comissaoModel->update($parcela['idComissao'], ['status' => 'Pago']);
        }
        
        return redirect()->back()->with('success', 'Pagamento registrado com sucesso');
    }

    public function gerarRecibo($idComissao)
    {
        $comissao = $this->comissaoModel
            ->select('comissoes.*, vendas.valor as valorVenda, 
                     corretores.nome as corretor, corretores.creci,
                     imoveis.titulo as imovel')
            ->join('vendas', 'vendas.idVenda = comissoes.idVenda')
            ->join('corretores', 'corretores.idCorretor = vendas.idCorretor')
            ->join('imoveis', 'imoveis.idImovel = vendas.idImovel')
            ->find($idComissao);

        $pdf = new PDFGenerator();
        $pdf->AddPage();
        
        // Cabeçalho do recibo
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'RECIBO DE COMISSÃO', 0, 1, 'C');
        
        $pdf->SetFont('helvetica', '', 12);
        $pdf->Cell(0, 10, 'Corretor: ' . $comissao['corretor'] . ' - CRECI: ' . $comissao['creci'], 0, 1);
        $pdf->Cell(0, 10, 'Valor: R$ ' . number_format($comissao['valor'], 2, ',', '.'), 0, 1);
        $pdf->Cell(0, 10, 'Referente à venda do imóvel: ' . $comissao['imovel'], 0, 1);
        
        return $this->response->download('recibo_comissao_' . $idComissao . '.pdf', $pdf->Output('', 'S'));
    }
}
