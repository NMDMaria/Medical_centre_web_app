<?php

function emptyField($data, $pswrd)
{
  if (empty($data) || empty($pswrd))
    return true;
  return false;
}

function userConnect($conn, $data, $pswrd)
{
  $sql = "select password from users where email = ? or username = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../login.php?error=wrong");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $data, $data);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result))
  {
    if (password_verify($pswrd, $row['password']) == true)
    {

      $sql = "select id_user, admin from users where password = ? and (email = ? or username = ?);";
      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql))
      {
        header("location: ../login.php?error=wrong");
        exit();
      }

      mysqli_stmt_bind_param($stmt, "sss", $row['password'], $data, $data);

      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result))
      {
        session_start();
        $_SESSION['login'] = $row['id_user'];
        if ($row['admin'] == 1)
          $_SESSION['admin'] = 1;
        // update last_online
        return true;
      }
      return false;
    }
  }
  return false;
  mysqli_stmt_close($stmt);
}
