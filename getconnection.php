<?php
$servername = "localhost";
$username = "newuser";
$password = "password";
$dbname = "spital";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM analize";
$result = mysqli_query($conn, $sql);

$analize = mysqli_fetch_all($result, MYSQLI_ASSOC);
print_r($analize);

$conn->close();
?>