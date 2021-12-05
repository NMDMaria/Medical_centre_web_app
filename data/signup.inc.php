<?php

if (isset($_POST["submit"]))
{
  $username = $_POST["username"];
  $mail = $_POST["mail"];
  $pswrd = $_POST["pswr"];
  $pswrdrep = $_POST["pswrdrep"];

  require_once 'cdb.inc.php';
  require_once 'singup_handle.inc.php';

  if (emptyField($username, $mail, $pswrd, $pswrdrep) !== false)
  {
    header("location: ../signup.php?error=emptyfield");
    exit();
  }
  if (validUsername($username) !== true)
  {
    header("location: ../signup.php?error=notvalidusername");
    exit();
  }
  if (validEmail($mail) !== true)
  {
    header("location: ../signup.php?error=notvalidmail");
    exit();
  }
  if (checkPass($pswrd, $pswrdrep) !== true)
  {
    header("location: ../signup.php?error=missmatchpassword");
    exit();
  }
  if (userExists($conn, $username, $mail) !== false)
  {
    header("location: ../signup.php?error=userexists");
    exit();
  }


  createUser($conn, $username, $mail, $pswrd);
  // display something - go to next page - create profile
}
else
{
  header("location: ../signup.php");
  exit();
}
