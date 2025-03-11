<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LocacaoModel;
use App\Models\ConfiguracaoModel;
use TCPDF; // Adicionar este use

class ContratosController extends BaseController
{
    protected $locacaoModel;
    protected $configuracaoModel;

    public function __construct()
    {
        $this->locacaoModel = new LocacaoModel();
        $this->configuracaoModel = new ConfiguracaoModel();
    }

    public function gerar($idLocacao)
    {
        // Query simplificada e corrigida
        $db = \Config\Database::connect();
        $sql = "SELECT l.*, i.*, 
                c1.nomeCliente as locador_nome, c1.documento as locador_documento,
                c2.nomeCliente as locatario_nome, c2.documento as locatario_documento
                FROM locacoes l
                JOIN imoveis i ON i.idImovel = l.idImovel
                JOIN clientes_locacoes cl1 ON cl1.idLocacao = l.idLocacao
                JOIN clientes c1 ON c1.idClientes = cl1.idClientes AND cl1.tipo_relacao = 'locador'
                JOIN clientes_locacoes cl2 ON cl2.idLocacao = l.idLocacao
                JOIN clientes c2 ON c2.idClientes = cl2.idClientes AND cl2.tipo_relacao = 'locatario'
                WHERE l.idLocacao = ?";

        $query = $db->query($sql, [$idLocacao]);
        $locacao = $query->getRow();

        if (!$locacao) {
            return redirect()->back()->with('error', 'Locação não encontrada');
        }

        // Debug
        log_message('debug', 'Query SQL: ' . str_replace('?', $idLocacao, $sql));
        log_message('debug', 'Resultado: ' . print_r($locacao, true));

        $data = [
            'titulo' => 'Contrato de Locação',
            'locacao' => $locacao
        ];

        return view('admin/contratos/preview', $data);
    }

    // O método download deve usar a mesma query
    public function download($idLocacao)
    {
        $db = \Config\Database::connect();
        // Usar a mesma query do método gerar
        $sql = "SELECT l.*, i.*, 
                c1.nomeCliente as locador_nome, c1.documento as locador_documento,
                c2.nomeCliente as locatario_nome, c2.documento as locatario_documento
                FROM locacoes l
                JOIN imoveis i ON i.idImovel = l.idImovel
                JOIN clientes_locacoes cl1 ON cl1.idLocacao = l.idLocacao
                JOIN clientes c1 ON c1.idClientes = cl1.idClientes AND cl1.tipo_relacao = 'locador'
                JOIN clientes_locacoes cl2 ON cl2.idLocacao = l.idLocacao
                JOIN clientes c2 ON c2.idClientes = cl2.idClientes AND cl2.tipo_relacao = 'locatario'
                WHERE l.idLocacao = ?";

        $query = $db->query($sql, [$idLocacao]);
        $locacao = $query->getRow();
        
        if (!$locacao) {
            return redirect()->back()->with('error', 'Locação não encontrada');
        }

        // Criar PDF
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
        // Configurar documento
        $pdf->SetCreator('Sistema Imobiliário');
        $pdf->SetAuthor('Sistema Imobiliário');
        $pdf->SetTitle('Contrato de Locação #' . $idLocacao);
        $pdf->SetMargins(20, 20, 20);
        $pdf->SetAutoPageBreak(TRUE, 25);

        $pdf->AddPage();
        
        // Título
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'CONTRATO DE LOCAÇÃO DE IMÓVEL RESIDENCIAL', 0, 1, 'C');
        $pdf->Ln(10);

        // Preâmbulo
        $pdf->SetFont('helvetica', '', 12);
        $pdf->MultiCell(0, 8, 'Pelo presente instrumento particular de locação de imóvel residencial, de um lado:', 0, 'J');
        $pdf->Ln(5);

        // Qualificação das Partes
        $pdf->MultiCell(0, 8, "LOCADOR: {$locacao->locador_nome}, {$this->formatarTipoPessoa($locacao->locador_documento)}, portador do documento nº {$locacao->locador_documento}, doravante denominado simplesmente LOCADOR.", 0, 'J');
        $pdf->Ln(5);
        
        $pdf->MultiCell(0, 8, "LOCATÁRIO: {$locacao->locatario_nome}, {$this->formatarTipoPessoa($locacao->locatario_documento)}, portador do documento nº {$locacao->locatario_documento}, doravante denominado simplesmente LOCATÁRIO.", 0, 'J');
        $pdf->Ln(10);

        // Cláusulas
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 8, 'CLÁUSULA PRIMEIRA - DO OBJETO', 0, 1, 'L');
        $pdf->SetFont('helvetica', '', 12);
        $pdf->MultiCell(0, 8, "1.1. O presente contrato tem como objeto a locação do imóvel situado à {$locacao->endereco}, {$locacao->cidade}/{$locacao->estado}, para fins exclusivamente residenciais.", 0, 'J');
        $pdf->Ln(5);

        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 8, 'CLÁUSULA SEGUNDA - DO PRAZO', 0, 1, 'L');
        $pdf->SetFont('helvetica', '', 12);
        $pdf->MultiCell(0, 8, "2.1. A locação terá início em " . date('d/m/Y', strtotime($locacao->dataInicio)) . " e término em " . date('d/m/Y', strtotime($locacao->dataTermino)) . ", com prazo de {$locacao->duracao} meses.", 0, 'J');
        $pdf->Ln(5);

        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 8, 'CLÁUSULA TERCEIRA - DO ALUGUEL E ENCARGOS', 0, 1, 'L');
        $pdf->SetFont('helvetica', '', 12);
        $pdf->MultiCell(0, 8, "3.1. O aluguel mensal é de R$ " . number_format($locacao->valorAluguel, 2, ',', '.') . " ({$this->valorPorExtenso($locacao->valorAluguel)}), a ser pago até o dia {$locacao->diaVencimento} de cada mês.", 0, 'J');
        
        if ($locacao->valorCondominio > 0) {
            $pdf->MultiCell(0, 8, "3.2. O valor do condomínio de R$ " . number_format($locacao->valorCondominio, 2, ',', '.') . " será pago pelo LOCATÁRIO.", 0, 'J');
        }
        
        if ($locacao->valorIPTU > 0) {
            $pdf->MultiCell(0, 8, "3.3. O IPTU no valor de R$ " . number_format($locacao->valorIPTU, 2, ',', '.') . " será pago pelo LOCATÁRIO.", 0, 'J');
        }
        $pdf->Ln(5);

        // Garantia
        if ($locacao->garantia) {
            $pdf->SetFont('helvetica', 'B', 12);
            $pdf->Cell(0, 8, 'CLÁUSULA QUARTA - DA GARANTIA', 0, 1, 'L');
            $pdf->SetFont('helvetica', '', 12);
            $pdf->MultiCell(0, 8, "4.1. Como garantia locatícia, o LOCATÁRIO opta pela modalidade {$locacao->garantia}, no valor de R$ " . number_format($locacao->valorGarantia, 2, ',', '.') . ".", 0, 'J');
            $pdf->Ln(5);
        }

        // Assinaturas
        $pdf->Ln(20);
        $pdf->Cell(0, 10, str_repeat('_', 50), 0, 1, 'C');
        $pdf->Cell(0, 5, 'LOCADOR', 0, 1, 'C');
        $pdf->Ln(10);
        $pdf->Cell(0, 10, str_repeat('_', 50), 0, 1, 'C');
        $pdf->Cell(0, 5, 'LOCATÁRIO', 0, 1, 'C');
        
        // Gerar arquivo
        $filename = "contrato_locacao_{$idLocacao}.pdf";
        return $pdf->Output($filename, 'D');
    }

    private function formatarTipoPessoa($documento)
    {
        return strlen(preg_replace('/[^0-9]/', '', $documento)) > 11 
            ? 'pessoa jurídica inscrita no CNPJ sob nº'
            : 'pessoa física inscrita no CPF sob nº';
    }

    private function valorPorExtenso($valor)
    {
        // Implementar função para converter valor em extenso
        // Por enquanto retorna o valor formatado
        return number_format($valor, 2, ',', '.');
    }

    public function enviar($idLocacao)
    {
        $locacao = $this->locacaoModel->find($idLocacao);
        // Enviar por email
    }
}
