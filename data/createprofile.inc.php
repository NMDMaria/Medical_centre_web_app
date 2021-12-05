<?php

if (isset($_POST["submit"]))
{
  session_start();
  $username = $_SESSION['username'];

  $nume = $_POST["nume"];
  $prenume = $_POST["prenume"];
  $cnp = $_POST["cnp"];
  $dob = $_POST["dob"];
  $gen = $_POST["gen"];

  require_once 'cdb.inc.php';
  require_once 'profile_handle.inc.php';

  if (emptyField($nume, $prenume, $cnp, $dob, $gen) !== false)
  {
       ?>
    <script type="text/javascript">
    window.location.href = 'https://negrutmariadaniela.000webhostapp.com/createprofile.php?error=emptyfield';
    </script>
    <?php
    exit();
  }
  $id_user = getUserid($conn, $username);
  if ($id_pac = profileExists($conn, $cnp) !== false)
  {
    // display if user wants to update current profile
    assocProfile($conn, $id_user, $id_pac);
    // check if he wants to update or not
    // if not exit

    if (updateProfile($conn, $id_pac, $nume, $prenume, $cnp, $dob, $gen) !== true)
    {
        ?>
    <script type="text/javascript">
    window.location.href = 'https://negrutmariadaniela.000webhostapp.com/createprofile.php?error=wrong';
    </script>
    <?php
      exit();
    }
  }

  if (createProfile($conn, $id_user, $nume, $prenume, $cnp, $dob, $gen) !== true)
  {
    ?>
    <script type="text/javascript">
    window.location.href = 'https://negrutmariadaniela.000webhostapp.com/createprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  // display user update succesful

}
else
{
  header("location: ../createprofile.php");
  exit();
}
