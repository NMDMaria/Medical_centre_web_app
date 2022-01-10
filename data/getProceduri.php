<?php

function getOperatii($conn)
{
  $sql = "select * from tipuri_operatii;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../completeprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_all($result, MYSQLI_ASSOC))
  {
    mysqli_stmt_close($stmt);
    return $row;
  }

  mysqli_stmt_close($stmt);
}

function getAfectiuni($conn)
{
  $sql = "select * from afectiuni;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../completeprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_all($result, MYSQLI_ASSOC))
  {
    mysqli_stmt_close($stmt);
    return $row;
  }

  mysqli_stmt_close($stmt);
}

function getMedicamente($conn)
{
  $sql = "select * from medicamente;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../completeprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_all($result, MYSQLI_ASSOC))
  {
    mysqli_stmt_close($stmt);
    return $row;
  }

  mysqli_stmt_close($stmt);
}

include_once('cdb.inc.php');
$operatii = getOperatii($conn);
$afectiuni = getAfectiuni($conn);
$medicamente = getMedicamente($conn);
