<?php

namespace App\Libraries;

use TCPDF;

class PDFGenerator extends TCPDF
{
    public function __construct()
    {
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
        $this->SetCreator(PDF_CREATOR);
        $this->SetAuthor('Sistema Imobiliário');
        $this->SetMargins(15, 15, 15);
        $this->SetAutoPageBreak(TRUE, 25);
    }

    public function Header()
    {
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 10, 'Sistema Imobiliário', 0, 1, 'C');
        $this->Ln(5);
    }

    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'C');
    }
}
