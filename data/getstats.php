<?php

function getstats($conn)
{
  $sql = "select * from stats where id = 1;";
  $stmt = mysqli_stmt_init($conn);

  mysqli_stmt_prepare($stmt, $sql);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $rows = mysqli_fetch_assoc($result);
  mysqli_stmt_close($stmt);
  return $rows;

}
