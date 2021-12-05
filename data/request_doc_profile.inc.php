<?php

if (isset($_POST["submit"]))
{
  session_start();
  $username = $_SESSION['username'];

  $nume = $_POST["nume"];
  $prenume = $_POST["prenume"];
  $cnp = $_POST["cnp"];
  $dob = $_POST["dob"];
  $tel = $_POST["nr_telefon"];
  $dom = $_POST["domeniu"];
  $mail = $_POST["email"];
  if (empty($mail))
  {
    // mail validation
    // nr_tel validation
    // cnp validation
    //$mail = $_SESSION['email'];
    $mail = 'abc@';
  }

  require_once 'cdb.inc.php';
  require_once 'profile_handle.inc.php';

  if (emptyField($nume, $prenume, $cnp, $dob, $tel, $dom) !== false)
  {
    header("location: ../doctorprofile.php?error=emptyfield");
    exit();
  }
  $id_user = getUserid($conn, $username);
  $id = profileDExists($conn, $cnp);
  if ($id !== false)
  {
    // display if user wants to update current profile
    aw_assocProfile($conn, $id_user, $id);
    // check if he wants to update or not
    // if not exit

    // display waiting for admin validation
  }

  if (createDProfile($conn, $id_user, $nume, $prenume, $cnp, $dob, $tel, $dom, $mail) !== true)
  {
    header("location: ../createprofile.php?error=wrong");
    exit();
  }
  else
  {
    ?>
    <script type="text/javascript">
    window.location.href = 'https://negrutmariadaniela.000webhostapp.com/index.php';
    </script>
    <?php
  }
  // display user update succesful

}
else
{
  header("location: ../createprofile.php");
  exit();
}

// display an admin will contact you soon
