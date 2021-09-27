<?php 

$server = "localhost";
$username = "root";
$pass = "";
$db = "db_absensi";

$conn = mysqli_connect($server, $username, $pass, $db);
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}