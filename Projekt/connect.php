<?php 
header('Content-Type: text/html; charset=utf-8');
$servername = "loopback:3307";
$username = "root";
$password = "";
$basename = "vijesti";

// Create connection 
$dbc = mysqli_connect($servername, $username, $password, $basename) or die('Error connecting to MySQL server.'.mysqli_error());
mysqli_set_charset($dbc, "utf8");
?>