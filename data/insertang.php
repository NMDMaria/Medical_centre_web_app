<?php
include_once 'cdb.inc.php';

function isemp($val)
{
  if (empty($val) || !$val)
  {
      header("location: ./completeprofile.php?error=empty");
      exit();
  }
}

$nume = mysqli_real_escape_string($conn, $_GET['nume']);
isemp($nume);
$prenume = mysqli_real_escape_string($conn, $_GET['prenume']);
isemp($prenume);
$cnp = mysqli_real_escape_string($conn, $_GET['cnp']);
isemp($cnp);
$dob = mysqli_real_escape_string($conn, $_GET['dob']);
isemp($dob);
$doa = mysqli_real_escape_string($conn, $_GET['doa']);
isemp($doa);
$tel = mysqli_real_escape_string($conn, $_GET['nr_telefon']);
isemp($tel);
$mail = mysqli_real_escape_string($conn, $_GET['email']);
isemp($mail);
$sal = mysqli_real_escape_string($conn, $_GET['sal']);
isemp($sal);
$bon = mysqli_real_escape_string($conn, $_GET['bonuss']);
