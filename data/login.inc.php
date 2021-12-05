<?php

if (isset($_POST["submit"]))
{
  $data = $_POST["data"];
  $pswrd = $_POST["pswr"];


  require_once 'cdb.inc.php';
  require_once 'login_handle.inc.php';

  if (emptyField($data, $pswrd) !== false)
  {
       ?>
    <script type="text/javascript">
    window.location.href = 'https://negrutmariadaniela.000webhostapp.com/login.php?error=emptyfield';
    </script>
    <?php
    exit();
  }
  if (userConnect($conn, $data, $pswrd) == false)
  {
       ?>
    <script type="text/javascript">
    window.location.href = 'https://negrutmariadaniela.000webhostapp.com/login.php?error=usernotexists';
    </script>
    <?php
    exit();
  }
  else
  {
    header("location: ../profile.php");
    exit();
  }
}
else
{
  header("location: ../index.php");
  exit();
}
