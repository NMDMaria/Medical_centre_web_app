<?php
include_once 'cdb.inc.php';
if (session_status() != 2)
  session_start();
session_unset();
mysqli_close($conn);
header("location: ../index.php");
