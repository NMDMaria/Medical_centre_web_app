<?php

/*
$serverName = "localhost";
$dbUser = "newuser";
$dbPassword = "";
$dbName = "spital";
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
