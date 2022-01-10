<?php
if(session_status()!=2) session_start();
if (!isset($_SESSION['pacient']) || !isset($_GET['id_pacient']) || !isset($_GET['id_programare']) || $_SESSION['pacient'] != $_GET['id_pacient'])
{
  ?>
  <script type="text/javascript">
  window.location.href = './index.php';
  </script>
  <?php
  exit();
}

require('./data/fpdf/fpdf.php');
include_once('./data/cdb.inc.php');
include_once('./data/reteta.inc.php');
$doctor = getDoc($conn, $_GET['id_programare']);
$pacient = getPac($conn, $_GET['id_pacient']);
$medicamente = getTr($conn, $_GET['id_pacient'], $_GET['id_programare']);
$diag = getDiag($conn,  $_GET['id_programare']);

$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$pdf->SetMargins(0,0,0);

$pdf->Image('./images/logo.png', 31, 23.9, 123.7, 27);
$pdf->SetFont('Times', '',16);
$pdf->SetXY(21, 57.187);
$pdf->Cell(31, 8.1, 'Nume: ');
$pdf->SetXY(52, 57.24);
$pdf->Cell(155, 8.1, $pacient['nume']);
$pdf->SetXY(21, 64.8);
$pdf->Cell(31, 8.1, 'Prenume:');
$pdf->SetXY(52, 64.8);
$pdf->Cell(155, 8.1, $pacient['prenume']);
$pdf->SetXY(21, 72.2);
$pdf->Cell(31, 8.1, 'CNP:');
$pdf->SetXY(52, 72.2);
$pdf->Cell(31, 8.1,  $pacient['cnp']);
$pdf->SetXY(114, 72.2);
$pdf->Cell(31, 8.1, 'Sex '.$pacient['gen']);
$pdf->SetXY(156, 72.2);
$pdf->Cell(20, 8.1, 'Varsta:');
$pdf->SetXY(175, 72.2);
$pdf->Cell(10, 8.1, $pacient['varsta']);
$pdf->SetXY(21, 79.6);
$pdf->Cell(20, 8.1, 'Diagnostic:');
$pdf->SetXY(52, 79.6);
$pdf->Cell(45, 8.1, $diag['denumire_afectiune']);
$pdf->SetXY(21, 87);
$pdf->Cell(20, 8.1, 'Data:');
$pdf->SetXY(52, 87);
$pdf->Cell(20, 8.1, $diag['data']);

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

/*
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
*/


for ($nr_medicamente = 0; $nr_medicamente < count($medicamente); $nr_medicamente++) {
  $pdf->SetXY(21, 107 + 7 * $nr_medicamente+ 7);
  $pdf->Cell(15, 8.1, $nr_medicamente + 1);
  $pdf->SetXY(38, 107 + 7 * $nr_medicamente+ 7);
  $pdf->Cell(15, 8.1, $medicamente[$nr_medicamente]['denumire']);
  $pdf->SetXY(140, 107 + 7 * $nr_medicamente+ 7);
  $pdf->Cell(15, 8.1, $medicamente[$nr_medicamente]['unitati_zi']);
  $pdf->SetXY(163, 107 + 7 * $nr_medicamente+ 7);
  $pdf->Cell(15, 8.1, $medicamente[$nr_medicamente]['durata']);
}

$pdf->SetFont('Times', '',16);
$pdf->SetXY(21, 257);
$nume = "";
if (isset($doctor['nume']))
  $nume = $doctor['nume'];
$prenume = "";
if (isset($doctor['prenume']))
  $nume = $doctor['prenume'];
$pdf->Cell(15, 8.1, $nume.' '.$prenume);

$pdf->Output();
