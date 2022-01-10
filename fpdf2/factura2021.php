<?php
require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
	// Logo
	$this->Image('img/header.png',0,0,210);
	// Arial bold 15
	$this->SetFont('Arial','B',48);
	// Move to the right
	$this->Ln(10);
	$this->Cell(108);
	// Title
	$this->Cell(0,10,'INVOICE',0,0,'C');
	// Line break
	$this->Ln(35);
}

// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	//$this->SetY(-15);
	$this->Image('img/footer.png',0,283,210);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	//$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$pdf->SetFont('Arial','',40);
$pdf->SetTextColor(60,60,60);
$pdf->Cell(3, 5,'Total:',0,0,'L');
$pdf->SetFont('Arial','',40);
$pdf->Cell(68, 5,' $200',0,0,'R');
$pdf->SetTextColor(0,0,0);

$pdf->Ln(20);

$y=$pdf->GetY();
$pdf->SetXY(0,$y);
$pdf->SetFont('Arial','',20);
$pdf->SetFillColor(120,120,120);
$pdf->Cell(20,20,' ',0,0,'L',1);
$pdf->Cell(20,20,'SL.',0,0,'C',1);
$pdf->Cell(80,20,'Item Description',0,0,'L',1);
$pdf->Cell(25,20,'Price',0,0,'C',1);
$pdf->Cell(20,20,'Qty.',0,0,'C',1);
$pdf->Cell(25,20,'Total:',0,0,'C',1);
$pdf->Cell(20,20,' ',0,1,'L',1);

$y=$pdf->GetY();
$pdf->SetXY(0,$y);
$pdf->Cell(20,20,' ',0,0,'L',1);
$pdf->Cell(20,20,'SL.',0,0,'C',1);
$pdf->Cell(80,20,'Item Description',0,0,'L',1);
$pdf->Cell(25,20,'Price',0,0,'C',1);
$pdf->Cell(20,20,'Qty.',0,0,'C',1);
$pdf->Cell(25,20,'Total:',0,0,'C',1);
$pdf->Cell(20,20,' ',0,1,'L',1);

$y=$pdf->GetY();
$pdf->SetXY(0,$y);
$pdf->Cell(20,20,' ',0,0,'L',1);
$pdf->Cell(20,20,'SL.',0,0,'C',1);
$pdf->Cell(80,20,'Item Description',0,0,'L',1);
$pdf->Cell(25,20,'Price',0,0,'C',1);
$pdf->Cell(20,20,'Qty.',0,0,'C',1);
$pdf->Cell(25,20,'Total:',0,0,'C',1);
$pdf->Cell(20,20,' ',0,1,'L',1);

$y=$pdf->GetY();
$pdf->SetXY(0,$y);
$pdf->Cell(20,20,' ',0,0,'L',1);
$pdf->Cell(20,20,'SL.',0,0,'C',1);
$pdf->Cell(80,20,'Item Description',0,0,'L',1);
$pdf->Cell(25,20,'Price',0,0,'C',1);
$pdf->Cell(20,20,'Qty.',0,0,'C',1);
$pdf->Cell(25,20,'Total:',0,0,'C',1);
$pdf->Cell(20,20,' ',0,1,'L',1);

$pdf->SetFont('Arial', 'B', 18);
$pdf->SetFillColor(120,120,12);
$pdf->SetXY(10,212);
$pdf->Cell(62, 8 ,'Payment info:  ', 0, 1, 'L', 0);
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(32, 6 ,'Account info:  ', 0, 0, 'L', 0);
$pdf->Cell(32, 6 ,'1234567890', 0, 1, 'R', 0);
$pdf->Cell(32, 6 ,'Account info:  ', 0, 0, 'L', 0);
$pdf->Cell(32, 6 ,'1234567890', 0, 1, 'R', 0);
$pdf->Cell(32, 6 ,'Account info:  ', 0, 0, 'L', 0);
$pdf->Cell(32, 6 ,'1234567890', 0, 1, 'R', 0);
$pdf->Cell(70, 3 ,'', 'B', 1, 0, 0);

$pdf->SetFont('Arial', 'B', 14);
$pdf->SetXY(62*2, 215);
$pdf->Cell(31, 8,'Subtotal:  ', 0, 0, 'L', 0);
$pdf->Cell(31, 8 ,'1234567890', 0, 1, 'R', 0);
$pdf->SetX(62*2);
$pdf->Cell(31, 8,'Tax:  ', 'B', 0, 'L', 0);
$pdf->Cell(31, 8 ,'0.00%', 'B', 1, 'R', 0);
$pdf->SetX(62*2);
$pdf->Cell(31, 8,'Total:  ', 0, 0, 'L', 0);
$pdf->Cell(31, 8 ,'$220.00', 0, 1, 'R', 0);

$pdf->SetXY(10, 243);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(120, 10,'Terms & condiitons', 0, 1, 'L', 0);
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(120, 6,'amet nibh. Pellentesque ornare aliquet turpis, vel viverra justo fermentum malesuada. ', 0, 'L', 0);

$pdf->SetX(10);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(100, 10,'Thank you for your business!', 0, 1, 'L', 0);

$pdf->SetXY(62*2+20, 263);
$pdf->Cell(40, 10,'Signature', 'T', 1, 'L', 0);

$pdf->Output();
?>
