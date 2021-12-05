<?php

function emptyField($username, $mail, $pswrd, $pswrdrep)
{
  if (empty($username) || empty($mail) || empty($pswrd) || empty($pswrdrep))
    return true;
  return false;
}


function validUsername($username)
{
  if (preg_match("/^[a-zA-Z0-9]*$/", $username))
    return true;
  return false;
}

function validEmail($mail)
{
  if (filter_var($mail, FILTER_VALIDATE_EMAIL))
    return true;
  return false;
}

function checkPass($pswrd, $pswrdrep)
{
  if ($pswrd !== $pswrdrep)
    return false;
  return true;
}

function userExists($conn, $username, $mail)
{
  $sql = "select 1 from users where username = ? or email = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../signup.php?error=wrong");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $username, $mail);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_fetch_assoc($result))
    return true;
  return false;

  mysqli_stmt_close($stmt);
}

function createUser($conn, $username, $mail, $pswrd)
{
  $sql = "insert into users(username, email, password) values (?,?,?)";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../signup.php?error=wrong");
    exit();
  }

  $hash = password_hash($pswrd, PASSWORD_DEFAULT);
  mysqli_stmt_bind_param($stmt, "sss", $username, $mail, $hash);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  session_start();
  $_SESSION['signup'] = true;
  $_SESSION['username'] = $username;
  $_SESSION['email'] = $mail;
  header("location: ../createprofile.php");
  exit();
}
