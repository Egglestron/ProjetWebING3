<?php
$mysqli_hostname = "localhost";
$mysqli_user = "root";
$mysqli_password = "";
$mysqli_database = "socialmedia";

$db = mysqli_connect($mysqli_hostname, $mysqli_user, $mysqli_password) or die("Opps some thing went wrong");
mysqli_select_db($db, $mysqli_database) or die("Opps some thing went wrong");

session_start();
?>
