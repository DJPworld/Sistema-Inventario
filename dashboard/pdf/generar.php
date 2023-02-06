<?php

require_once 'fpdf/fpdf.php';

class PDF extends FPDF
{
    function Header()
    {
        $this->AddLink();
        $this->Image('../img/educacion.jpg',10,10,30,0);
        $this->Image('../img/tecnm.jpg',50,10,20,0);
        $this->Image('../img/logo.jpg',80,10,12,0);
        $this->SetFont('Arial','B',12);
        $this->Cell(80);
        $this->Cell(30,50, utf8_decode('Instituto Tecnológico Superior de la Región Sierra'),0,1,'L');
        $this->SetFont('Arial','B',10);
        $this->Cell(80);
        $this->Cell(-18, 5, utf8_decode('LIC. MANUEL RIVERA LANDERO'),0,1,"R", 0);
        $this->Cell(92,5, utf8_decode('ANALISTA TECNICO DEL AREA DE INFORMATICA'),0,1,'R');
        $this->Cell(26,5, utf8_decode('PRESENTE'),0,1,'R');
        $this->Ln(10);

        $this->Cell(10, 10, 'id', 1, 0 , "C", 0);
        $this->Cell(90, 10, 'diagnostico', 1, 0 , "C", 0);     
        $this->Cell(90, 10, 'problema', 1, 1 , "C", 0);
    }

    function Footer()
    {
        $this->SetY(-18);
        $this->SetFont('Arial','I',12);
        $this->AddLink();
        $this->Image('../img/tec.jpg',10,260,15,0);
        $this->Image('../img/libredeplastico.jpg',40,260,20,0);
        $this->Cell(5,10, utf8_decode('Carretera Teapa-Tacotalpa Km 4.5, Francisco Javier Mina, Tabasco 86801 Teapa-Tabasco.'),0,0,'L');
    }
}

require 'cn.php';
$consulta = "select * from solicitudes";
$resultado = $mysqli->query($consulta);

$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',10);

while($row = $resultado->fetch_assoc()){
    $pdf->Cell(10, 10, $row['id_equipo'], 1, 0 , "C", 0);
    $pdf->Cell(90, 10, $row['diagnostico'], 1, 0, "C", 0);
    $pdf->Cell(90, 10, $row['problema'], 1, 1, "C", 0);
}

$pdf->Cell(30,100, utf8_decode('ATENTAMENTE'),0,1,'R');
$pdf->Cell(67,-90, utf8_decode('Excelencia en Educación Tecnológica'),0,1,'R');
$pdf->Cell(88,100, utf8_decode('Innovación Tecnológica y Superación por Siempre'),0,1,'R');


$pdf->Cell(82,10, utf8_decode('ING. HUMBERTO JAVIER GUIRAO MARTINEZ.'),0,1,'R');
$pdf->Cell(75,5, utf8_decode('AREA DE INFORMATICA INSTITUCIONAL.'),0,1,'R');

$pdf->Output();

?>