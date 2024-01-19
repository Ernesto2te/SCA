<?php 
require '../pdf/fpdf.php';



class PDF extends FPDF
{
    function Header()
    {
        $this->Image('../assets/images/ejemplos/itsvc_logo7.jpg', 10, 5, 30, 0, '');
        // Posición actual
        $x = $this->GetX();
        $y = $this->GetY();

        $this->Image('../assets/images/ejemplos/gobierno-logo.png', 160, $y, 35, 0, '');
        $this->Image('../assets/images/ejemplos/tecnm.png', 160, $y+20, 35, 0, ''); // Agregamos +20 para bajar la imagen 

        $this->Ln(9);
        $this->SetFont('Arial', 'B', 13);
        $this->Cell(75);
        $this->Cell(30, 5, 'INSTITUTO TECNOLOGICO SUPERIOR DE', 0, 1, 'C');
        $this->Cell(75);
        $this->Cell(30, 5, 'VENUSTIANO CARRANZA', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 13);

        $this->Ln(15);
    } 

    function Footer()
    {
        $this->SetY(-18);
        $this->SetFont('Arial', 'I',12);
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().' de {nb}',0,0,'C' ); 
        $this->Ln();
        $this->Cell(50);
        $this->Cell(100,5,'ESTE DOCUMENTO NO TIENE VALIDEZ OFICIAL, SOLO ES UNA REFERENCIA.',0,1,'C');
        $this->SetFont('Arial','I',5);
    } 

    function BodyText($file)
    {
        // LEO ARCHIVO TXT
        $txt = file_get_contents($file);
        // INSERTO FUENTE Y TAMAÑO
        $this->SetFont('Times','',12);
        // JUSTIFICO TEXTO
        $this->MultiCell(0,5,$txt);
        // INGRESO SALTO LINEA
        $this->Ln();
        // AÑADO TEXTO FIN CAPITULO EN ITÁLICA
        $this->SetFont('','I');
        $this->Cell(0,5,'(fin del capítulo)');
    }
}



?> 

