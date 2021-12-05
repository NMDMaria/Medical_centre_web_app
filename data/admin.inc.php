<?php
  include_once 'cdb.inc.php';
  function getV($conn)
  {
    $sql = "select * from await_admin_validation where validated = 0;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql))
    {
      header("location: ../admin_homepage.php?error=wrong");
      exit();
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result))
      $rows[] = $row;
    return $rows;

    mysqli_stmt_close($stmt);
  }

  if (session_status() != 2) session_start();
  if (!isset($_SESSION['login']) || !isset($_SESSION['admin']) || $_SESSION['admin'] != 1)
  {
    header("location: ../index.php");

  }
  $id_user = $_SESSION['login'];
  $data = getV($conn);
