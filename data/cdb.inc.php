<?php

/*
$serverName = "localhost";
$dbUser = "newuser";
$dbPassword = "";
$dbName = "spital";
// o sa le iau din alt fisier protected trb sa vad cum fac asta
// but so far so good
*/
$serverName = "localhost";
$dbUser = "id17938187_newuser";
$dbPassword = "";
$dbName = "id17938187_spital";

$conn = mysqli_connect($serverName, $dbUser, $dbPassword, $dbName);

if (!$conn)
{
  die("Connection failed: " . mysqli_connect_error());
}
ob_start();