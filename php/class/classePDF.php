<?php
/**
 * classePDF.php: classe que esten la classe FPDF per canviar el Header i Footer dels arxius PDF que generem.
 */
/**
 * Fem un require_once de la classe FPDF.
 */
require_once $_SERVER['DOCUMENT_ROOT']."/php/fpdf/fpdf.php";
/**
 * Classe PDF: esten la classe FPDF per generar documents .pdf
 */
class PDF extends FPDF
{
    /**
     * Mètode Header: li posem un logo, un tipus de lletra i un títol al header dels PDF que generarem.
     */
    public function Header()
    {
        // Logo
        $this->Image('../../img/univeylandia_logo.png', 10, 6, 30);
        // Arial negreta 15
        $this->SetFont('Arial', 'B', 15);
        // Moure a la dreta
        $this->Cell(70);
        // Títol
        $this->Cell(50, 10, $this->metadata['Title'], 1, 0, 'C');
        // Line break
        $this->Ln(20);
    }

    /**
     * Mètode Footer: posa un footer amb un número de pàgina.
     */
    public function Footer()
    {
        // Posició: a 1.5 cm del final de la fulla
        $this->SetY(-15);
        // Arial cursiva 8
        $this->SetFont('Arial', 'I', 8);
        // Número de pàgina
        $this->Cell(0, 10, 'Pag. '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
}
