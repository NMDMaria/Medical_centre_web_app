<?php
include_once 'cdb.inc.php';
header('Content-Type: application/json');
function deleteProgr($conn, $id_pacient, $id_doctor)
{
  if ($_COOKIE['progr_Start'] && $_COOKIE['progr_End'])
  {
    $split = explode("T", $_COOKIE['progr_Start']);
    $data = $split[0];
    $split = $split[1];
    $split = explode("+", $split);
    $ora =  $split[0];

    $split = explode("T", $_COOKIE['progr_End']);
    $oraf = explode('+', $split[1])[0];

    $sql = "insert into programari(id_pacient, data, tip, status, ora, id_doctor, ora_sfarsit) values (?, ?, 'Normal', 'Astepare', ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql))
    {
      header("location: ../programare.php?error=wrong");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "issis", $id_pacient, $data, $ora, $id_doctor, $oraf);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $sql = "select id_programre from programari where id_pacient = ? and id_doctor = ? and data = ? and ora = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql))
    {
      header("location: ../programare.php?error=wrong");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "iiss", $id_pacient, $id_doctor, $data, $ora);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result))
    {
      mysqli_stmt_close($stmt);
      return $row['id_programare'];
    }
    mysqli_stmt_close($stmt);
  }
  return -1;
}


$aResult = array();

if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

if( !isset($aResult['error']) ) {

   switch($_POST['functionname']) {
       case 'makeProgr':
          if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 2) ) {
              $aResult['error'] = 'Error in arguments!';
          }
          else {
              $aResult['result'] = makeProgr($conn ,$_POST['arguments'][0], $_POST['arguments'][1]);
          }
          break;

       default:
          $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
          break;
   }

}

echo json_encode($aResult);
