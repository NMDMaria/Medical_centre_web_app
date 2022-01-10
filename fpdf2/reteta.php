<?php
require('fpdf.php');

$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$pdf->SetMargins(0,0,0);

$pdf->Image('img/logo.png', 31, 23.9, 123.7, 27);
$pdf->SetFont('Times', '',16);
$pdf->SetXY(21, 57.187);
$pdf->Cell(31, 8.1, 'Nume: ');
$pdf->SetXY(52, 57.24);
$pdf->Cell(155, 8.1, 'Lorem ipsum dolor sit amet, consectetur_______________');
$pdf->SetXY(21, 64.8);
$pdf->Cell(31, 8.1, 'Prenume:');
$pdf->SetXY(52, 64.8);
$pdf->Cell(155, 8.1, 'Lorem ipsum dolor sit amet, consectetur_______________');
$pdf->SetXY(21, 72.2);
$pdf->Cell(31, 8.1, 'CNP:');
$pdf->SetXY(52, 72.2);
$pdf->Cell(31, 8.1, '1234567890000');
$pdf->SetXY(114, 72.2);
$pdf->Cell(31, 8.1, 'Sex M/F');
$pdf->SetXY(156, 72.2);
$pdf->Cell(20, 8.1, 'Varsta:');
$pdf->SetXY(175, 72.2);
$pdf->Cell(10, 8.1, '1234');
$pdf->SetXY(21, 79.6);
$pdf->Cell(20, 8.1, 'Diagnostic:');
$pdf->SetXY(52, 79.6);
$pdf->Cell(45, 8.1, 'Lorem ipsum dolor sit amet, consectetur');
$pdf->SetXY(21, 87);
$pdf->Cell(20, 8.1, 'Data:');
$pdf->SetXY(52, 87);
$pdf->Cell(20, 8.1, 'YYYY/MM/DD');

$pdf->SetFont('Times', '',14);
$pdf->Line(21, 107, 21, 247);
$pdf->Line(188, 107, 188, 247);
$pdf->Line(21, 107, 188, 107);
$pdf->Line(21, 247, 188, 247);

$pdf->SetXY(21, 107);
$pdf->Cell(15, 8.1, 'Nr.Crt.');
$pdf->Line(37, 107, 37, 247);
$pdf->SetXY(38, 107);
$pdf->Cell(15, 8.1, 'Denumire medicament');
$pdf->Line(138, 107, 138, 247);
$pdf->SetXY(140, 107);
$pdf->Cell(15, 8.1, 'Unitati/zi');
$pdf->Line(162, 107, 162, 247);
$pdf->SetXY(163, 107);
$pdf->Cell(15, 8.1, 'Nr. zile');

$pdf->Line(21, 114, 188, 114);

// incap exact 20 de medicamente in tabel
for ($nr_medicamente=1; $nr_medicamente < 20; $nr_medicamente++) {
  $pdf->SetXY(21, 107 + 7 * $nr_medicamente);
  $pdf->Cell(15, 8.1, '1');
  $pdf->SetXY(38, 107 + 7 * $nr_medicamente);
  $pdf->Cell(15, 8.1, 'Denumire medicament');
  $pdf->SetXY(140, 107 + 7 * $nr_medicamente);
  $pdf->Cell(15, 8.1, '15ml');
  $pdf->SetXY(163, 107 + 7 * $nr_medicamente);
  $pdf->Cell(15, 8.1, '3');
}

$pdf->SetFont('Times', '',16);
$pdf->SetXY(21, 257);
$pdf->Cell(15, 8.1, 'Nume si prenume doctor');
$pdf->Output();
?>
