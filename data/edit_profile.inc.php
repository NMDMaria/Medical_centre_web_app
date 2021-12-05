<?php
include_once 'cdb.inc.php';
function update_column($conn, $table, $col_name, $value, $id_user)
{
  $sql = "update ? set ? = ? where id_user = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../profile.php?error=wrong");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "sssi", $table, $col_name, $value, $id_user);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_stmt_affected_rows($stmt) > 1)
  {
    header("location: ../profile.php?error=wrong");
    exit();
  }
  mysqli_stmt_close($stmt);
}

if (isset($_GET['edit']) && $_GET['edit'] == true)
{
  if (!isset($_GET['acc_edit']) || $_GET['acc_edit'] != true)
  {
    header("location: ../profile.php?edit=true");
    exit();
  }
  else
  {
    if (!isset($_GET['angajat_type']))
    {
            $nume = $_GET['nume'];
            $prenume = $_GET['prenume'];
            $cnp = $_GET['cnp'];
            $dob = $_GET['dob'];
            $gen = $_GET['gen'];
            if (session_status() != 2) session_start();
            $id_user = $_SESSION['login'];
            if (!empty($nume))
            {
                update_column($conn, "pacienti", "nume", $nume, $id_user);
                $_SESSION['updateSomething'] = true;
            }
            if (!empty($prenume))
            {
              update_column($conn, "pacienti", "prenume", $prenume, $id_user);
              $_SESSION['updateSomething'] = true;
            }
            if (!empty($cnp))
            {
              update_column($conn, "pacienti", "cnp", $cnp, $id_user);
              $_SESSION['updateSomething'] = true;
            }
            if (!empty($dob))
            {
              update_column($conn, "pacienti", "data_nasterii", $dob, $id_user);
              $_SESSION['updateSomething'] = true;
            }
            if (!empty($gen))
            {
              update_column($conn, "pacienti", "gen", $gen, $id_user);
              $_SESSION['updateSomething'] = true;
            }
            header("location: ./profile.php");
    }
    else
    {
      $nume = $_GET['nume'];
      $prenume = $_GET['prenume'];
      $cnp = $_GET['cnp'];
      $dob = $_GET['dob'];
      $tel = $_GET['nr_telefon'];
      $mail = $_GET['email'];
      if ($_GET['angajat_type'] == 'Personal_medical')
      {
        $sediu = $_GET['sediu'];
        $cam = $_GET['cabinet'];
      }
      if (session_status() != 2) session_start();
      $id_user = $_SESSION['login'];
      if (!empty($nume))
      {
          update_column($conn, "angajati", "nume", $nume, $id_user);
          $_SESSION['updateSomething'] = true;
      }
      if (!empty($prenume))
      {
        update_column($conn, "angajati", "prenume", $prenume, $id_user);
        $_SESSION['updateSomething'] = true;
      }
      if (!empty($cnp))
      {
        update_column($conn, "angajati", "cnp", $cnp, $id_user);
        $_SESSION['updateSomething'] = true;
      }
      if (!empty($dob))
      {
        update_column($conn, "angajati", "data_nasterii", $dob, $id_user);
        $_SESSION['updateSomething'] = true;
      }
      if (!empty($tel))
      {
        update_column($conn, "angajati", "nr_telefon", $tel, $id_user);
        $_SESSION['updateSomething'] = true;
      }
      if (!empty($tel))
      {
        update_column($conn, "angajati", "email", $mail, $id_user);
        $_SESSION['updateSomething'] = true;
      }
      if (isset($sediu) && !empty($tel))
      {
        $sql = "update ? set ? = ? where id_user = ?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql))
        {
          header("location: ../profile.php?error=wrong");
          exit();
        }

        mysqli_stmt_bind_param($stmt, "sssi", $table, $col_name, $value, $id_user);

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 1)
        {
          header("location: ../profile.php?error=wrong");
          exit();
        }
        mysqli_stmt_close($stmt);

        $_SESSION['updateSomething'] = true;
      }
      if (isset($cam) && !empty($cam))
      {
        //update_column($conn, "angajati", "cabinet_nr_camera", $tel, $id_user);
        $_SESSION['updateSomething'] = true;
      }
      header("location: ../profile.php");
    }
  }
    header("location: ../profile.php");
}
else
{
  header("location: ../profile.php");
  exit();
}
