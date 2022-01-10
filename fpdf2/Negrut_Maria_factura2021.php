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
	$this->SetY(-8);
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
$pdf->SetFont('Arial','',35);
$pdf->SetTextColor(60,60,60);
$pdf->setX(15);
$pdf->Cell(20,10,'Total',0,0,'L');
$pdf->Cell(75,10,' $220.00',0,0,'R');

$pdf->SetTextColor(0,0,0);
$x = $pdf->getX() + 15;
$pdf->setXY($x, $pdf->getY());
$pdf->SetFont('Arial','B',14);
$pdf->Cell(10, 5, 'Invoice# ', 0, 0, 'L');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(65, 5, '12345 ', 0, 1, 'R');
$pdf->setXY($x, $pdf->getY() + 2);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(10, 5, 'Date ', 0, 0, 'L');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(65, 5, '13/12/2021 ', 0, 1, 'R');

$pdf->SetFont('Arial','B',14);
$pdf->SetXY(17, $pdf->GetY() + 5);
$pdf->Cell(20, 5, 'Invoice to: ', 0, 0, 'L');
$pdf->SetXY($pdf->GetX() +  10, $pdf->GetY() - 0.2);
$pdf->Cell(20, 5, 'John Doe', 0, 0, 'L');
$pdf->SetXY($pdf->GetX() + 5, $pdf->GetY() - 0.2);
$pdf->SetFont('Arial','',12);
$pdf->Cell(60, 5, 'Str. Academiei nr.14, 010014 Bucuresti', 0, 0, 'L');

$pdf->SetDrawColor(33, 33, 33);
$y=$pdf->GetY() + 10;
$pdf->SetXY(0,$y);
$pdf->SetFont('Arial','B',18);
$pdf->SetFillColor(242, 242, 242);
$pdf->Cell(20,15,' ',0,0,'L',1);
$pdf->Cell(20,15,'SL.',0,0,'C',1);
$pdf->Cell(80,15,'Item Description',0,0,'L',1);
$pdf->Cell(25,15,'Price',0,0,'C',1);
$pdf->Cell(20,15,'Qty.',0,0,'C',1);
$pdf->Cell(25,15,'Total:',0,0,'C',1);
$pdf->Cell(20,15,' ',0,1,'L',1);

$pdf->SetFont('Arial','',14);
$y=$pdf->GetY();
$pdf->SetXY(0,$y);
$pdf->Cell(20,20,' ','',0,'L',1);
$pdf->Cell(20,20,'1.','B',0,'C',1);
$pdf->Cell(80,20,'Item Description','B',0,'L',1);
$pdf->Cell(25,20,'$50','B',0,'C',1);
$pdf->Cell(20,20,'1.','B',0,'C',1);
$pdf->Cell(25,20,'$50','B',0,'C',1);
$pdf->Cell(20,20,' ',0,1,'L',1);

$y=$pdf->GetY();
$pdf->SetXY(0,$y);
$pdf->Cell(20,20,' ',0,0,'L',1);
$pdf->Cell(20,20,'2.','BT',0,'C',1);
$pdf->Cell(80,20,'Item Description','BT',0,'L',1);
$pdf->Cell(25,20,'$20','BT',0,'C',1);
$pdf->Cell(20,20,'3','BT',0,'C',1);
$pdf->Cell(25,20,'$60','BT',0,'C',1);
$pdf->Cell(20,20,' ',0,1,'L',1);

$y=$pdf->GetY();
$pdf->SetXY(0,$y);
$pdf->Cell(20,20,' ',0,0,'L',1);
$pdf->Cell(20,20,'3.','BT',0,'C',1);
$pdf->Cell(80,20,'Item Descriptio','BT',0,'L',1);
$pdf->Cell(25,20,'$10','BT',0,'C',1);
$pdf->Cell(20,20,'2','BT',0,'C',1);
$pdf->Cell(25,20,'$20','BT',0,'C',1);
$pdf->Cell(20,20,' ',0,1,'L',1);

$y=$pdf->GetY();
$pdf->SetXY(0,$y);
$pdf->Cell(20,20,' ',0,0,'L',1);
$pdf->Cell(20,20,'4.','BT',0,'C',1);
$pdf->Cell(80,20,'Item Description','BT',0,'L',1);
$pdf->Cell(25,20,'$90','BT',0,'C',1);
$pdf->Cell(20,20,'1','BT',0,'C',1);
$pdf->Cell(25,20,'$90','BT',0,'C',1);
$pdf->Cell(20,20,' ',0,1,'L',1);
$y=$pdf->GetY();
$pdf->SetXY(0,$y);
$pdf->Cell(20,20,' ',0,0,'L',1);
$pdf->Cell(20,20,' ','BT',0,'C',1);
$pdf->Cell(80,20,' ','BT',0,'L',1);
$pdf->Cell(25,20,' ','BT',0,'C',1);
$pdf->Cell(20,20,' ','BT',0,'C',1);
$pdf->Cell(25,20,' ','BT',0,'C',1);
$pdf->Cell(20,20,' ',0,1,'L',1);

$y=$pdf->GetY();
$pdf->SetXY(0,$y);
$pdf->Cell(20, 10,' ',0,0,'L',1);
$pdf->Cell(170, 10, ' ', 0, 0, 0, 1);
$pdf->Cell(20,10,' ',0,0,'L',1);


$pdf->SetXY(0,205);
$pdf->SetFont('Arial','B',18);

$pdf->ln(5);
$savey=$pdf->GetY();

$pdf->SetX(10);
$pdf->Cell(62,8,'Payment Info:',0,1,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(31,6,'Account #:',0,0,'L');
$pdf->Cell(31,6,'1234 5678 9012:',0,1,'L');
$pdf->Cell(31,6,'A/C Name:',0,0,'L');
$pdf->Cell(31,6,'Lorem ipsum',0,1,'L');
$pdf->Cell(31,6,'Bank Details #:',0,0,'L');
$pdf->Cell(31,6,'Add your details',0,1,'L');
$pdf->Cell(31,2,' ','B',0,'L');
$pdf->Cell(31,2,' ','B',1,'L');

$pdf->SetY($savey);
$pdf->SetX(62*2+5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(31,10,'Sub Total:',0,0,'L');
$pdf->Cell(31,10,'$220.00',0,1,'R');
$pdf->SetX(62*2+5);
$pdf->Cell(31,10,'Tax:','B',0,'L');
$pdf->Cell(31,10,'0.00%','B',1,'R');
$pdf->SetFont('Arial','B',14);
$pdf->SetX(62*2+5);
$pdf->Cell(31,12,'Total:',0,0,'L');
$pdf->Cell(31,12,'$220.00',0,1,'R');

$pdf->ln(2);
$pdf->SetX(10);
$pdf->SetFont('Arial','',16);
$pdf->Cell(120,10,'Term & Conditions',0,1,'L');
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(255,255,255);
$pdf->MultiCell(120,3,'Vizualizarea facturii sau a altor documente trimise electronic se realizeaza prin ',0,1,'L',0);

$savey=$pdf->GetY();
$pdf->ln(10);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(120,6,'Thank you for your business',0,1,'L');



$pdf->SetXY(10+62*2+5,$savey+2);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(42,12,'Authorised Signs','T',0,'C');




$pdf->Output();
?>
